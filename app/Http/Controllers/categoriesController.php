<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getData(){
        return Category::all();
        
    }
       public function stiched()
    {
   
    return view('public.stiched', [
        'products' => $this->getData()
    ]);

    }
       public function unstitched()
    {
   
    return view('public.unstiched', [
        'products' => $this->getData()
    ]);

    }
       public function shopPage()
    {
    return view('public.shop', [
        'products' => $this->getData()
    ]);
      
    }
    public function homePage()
    {
    // return view('public.home', [
    //     'products' => $this->getData()
    // ]);
             $products = Category::orderBy('updated_at', 'desc')->get();

        return view('public.home', compact('products'));
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
            'type.*' => 'in:Stitched,Unstitched,Ebriodory',
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
      $products = Category::where('Cid', $id)->get();
        return view('public.productPage', [
            'products' => $products
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
