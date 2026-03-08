<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getData(){
        return Category::select('*');
        
    }
       public function stiched()
    {
   
     $products = Category::whereJsonContains('type', 'Stitched')
                        ->paginate(12);

    return view('public.stiched', compact('products'));

    }
       public function unstitched()
    {
   
    $products = Category::whereJsonContains('type', 'Unstitched')
                        ->paginate(12);

    return view('public.unstiched', compact('products'));

    }
      public function embroidery()
    {
   
    $products = Category::whereJsonContains('type', 'Embroidery')
                        ->paginate(12);

    return view('public.embroidery', compact('products'));

    }
 public function shopPage()
{
    $products = $this->getData()->paginate(12);

    if(request()->ajax()){
        return view('public.partials.cards_shopproduct', compact('products'))->render();
    }

    return view('public.shop', compact('products'));
}


    public function homePage()
    {
    // return view('public.home', [
    //     'products' => $this->getData()
    // ]);
             $products = Category::orderBy('updated_at', 'desc')->get();
              $reviews = Review::with('user')->where('status', 'approved')->latest()->take(5)->get();

        return view('public.home', compact('products', 'reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
           'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'description' => 'required |string' ,
            'size' => 'required|array',           // array hona chahiye
            'size.*' => 'in:Small,Medium,Large,XL,XXL,XXXL',  // har ek value allowed
            'type' => 'required|array',
            'type.*' => 'in:Stitched,Unstitched,Embroidery',
            'homepage_choice' => 'nullable|array', 
            'homepage_choice.*' => 'in:None,Featured Product,Bestsellers of the Month',
            'quantity' => 'required|integer|min:0',
            'category' => 'required', // allowed dropdown values
            'availability' => 'required|in:In Stock,Out of Stock',
            'sku' => 'required|string|max:100|unique:categories,sku',
            'fabric' => 'nullable|string|max:100',
            'style_detail' => 'nullable|string|max:100',
            'care' => 'nullable|string|max:150',
            'color' => 'nullable|string|max:50',
             'images' => 'required',
           'images.*' => 'required|image|max:3000',
             
        ]);
        $types = $request->type;
        $homepageChoices = $request->homepage_choice ?? ['None'];
         $imageNames = [];
        foreach($request->file('images') as $image){
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('image/categories_image'), $image_name);
            $imageNames[] = $image_name;
        }
        $category = Category::create([
            'product_name' => $request->product_name ,
            'price' => $request->price ,
            'old_price' => $request->old_price ,
            'description' => $request->description ,
            'size' => json_encode($request->size),
             'type' => json_encode($types),
            'homepage_choice' => json_encode($homepageChoices),
            'quantity' => $request->quantity ,
            'category' => $request->category ,
            'availability' => $request->availability ,
            'sku' => $request->sku ,
            'fabric' => $request->fabric ,
            'style_detail' => $request->style_detail ,
            'care' => $request->care ,
            'color' => $request->color ,
            'image' => json_encode($imageNames),

        ]);
        return redirect('/dashboard')->with('status', 'Data has been saved');
    }

    // Cart controller store method
    
    public function addTocart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cart logic here (e.g., add to session or database)

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $products = Category::with([
            'approvedReviews' => function ($query) {
                $query->with('user')->latest();
            },
            'reviews' => function ($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->whereRaw('1 = 0');
                }
            },
        ])->where('Cid', $id)->get();
        return view('public.productPage', [
            'products' => $products
        ]);

    }



    public function storeReview(Request $request, string $id)
    {
        $product = Category::where('Cid', $id)->firstOrFail();

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1200',
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->Cid,
            ],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
                'status' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
            ]
        );

        return redirect()->back()->with('review_status', 'Your review has been submitted and is pending admin approval.');
    }

    public function updateReviewStatus(Request $request, Review $review)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $review->status = $validated['status'];
        $review->approved_by = $validated['status'] === 'approved' ? Auth::id() : null;
        $review->approved_at = $validated['status'] === 'approved' ? now() : null;
        $review->save();

        return redirect()->back()->with('success', 'Review status updated successfully.');
    }
    public function display(){
        $products = Category::all();
        return view('public.forms.s&u_display', compact('products'));
    }

    // Filteration
   public function filter(Request $request)
{
    $query = Category::query();

    // page/type ke hisaab se data filter
    if ($request->type === 'Stitched') {
        $query->whereJsonContains('type', 'Stitched');
    } elseif ($request->type === 'Unstitched') {
        $query->whereJsonContains('type', 'Unstitched');
    } elseif ($request->type === 'Embroidery') {
        $query->whereJsonContains('type', 'Embroidery');
    }

    // sort
    if ($request->sort === 'low') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'high') {
        $query->orderBy('price', 'desc');
    } else {
        $query->latest('updated_at');
    }

    $products = $query->paginate(12);

    // ajax par sirf cards return
    if ($request->ajax()) {
        if ($request->type === 'Stitched') {
            return view('public.partials.cards_stiched', compact('products'))->render();
        }

        if ($request->type === 'Unstitched') {
            return view('public.partials.cards_unstiched', compact('products'))->render();
        }
        if ($request->type === 'Embroidery') {
            return view('public.partials.cards_embroidery', compact('products'))->render();
        }

        return view('public.partials.cards_shopproduct', compact('products'))->render();
    }

    // non-ajax fallback
    if ($request->type === 'Stitched') return view('public.stiched', compact('products'));
    if ($request->type === 'Unstitched') return view('public.unstiched', compact('products'));
    if ($request->type === 'Embroidery') return view('public.embroidery', compact('products'));
    return view('public.shop', compact('products'));
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Category::findOrFail($id);
        return view('public.forms.category_edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'description' => 'required|string',
            'size' => 'required|array',
            'size.*' => 'in:Small,Medium,Large,XL,XXL,XXXL',
            'type' => 'required|array',
            'type.*' => 'in:Stitched,Unstitched,Embroidery',
            'homepage_choice' => 'nullable|array',
            'homepage_choice.*' => 'in:None,Featured Product,Bestsellers of the Month',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string',
            'availability' => 'required|in:In Stock,Out of Stock',
            'sku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories', 'sku')->ignore($category->Cid, 'Cid'),
            ],
            'fabric' => 'nullable|string|max:100',
            'style_detail' => 'nullable|string|max:100',
            'care' => 'nullable|string|max:150',
            'color' => 'nullable|string|max:50',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:3000',
        ]);

        $imageNames = json_decode($category->image, true) ?? [];

        if ($request->hasFile('images')) {
            // Replace old images only when new files are uploaded.
            foreach ($imageNames as $oldImage) {
                $oldPath = public_path('image/categories_image/' . $oldImage);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/categories_image'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        $category->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'description' => $request->description,
            'size' => json_encode($request->size),
            'type' => json_encode($request->type),
            'homepage_choice' => json_encode($request->homepage_choice ?? ['None']),
            'quantity' => $request->quantity,
            'category' => $request->category,
            'availability' => $request->availability,
            'sku' => $request->sku,
            'fabric' => $request->fabric,
            'style_detail' => $request->style_detail,
            'care' => $request->care,
            'color' => $request->color,
            'image' => json_encode($imageNames),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Data has been updated',
                'redirect' => route('su_display'),
            ]);
        }

        return redirect('/display')->with('status', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        category::destroy($id);
        return redirect('/display')->with('status', 'Data has been deleted');
    }
}
