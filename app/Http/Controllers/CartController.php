<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;       
use Illuminate\Support\Facades\Session;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:categories,Cid',
        'quantity'   => 'required|integer|min:1',
        'size'       => 'nullable|string',
        'type'       => 'nullable|string',
    ]);

    Cart::create([
        'user_id'   => Auth::check() ? Auth::id() : null,
        'session_id'=> Auth::check() ? null : Session::getId(),
        'Cid'       => $request->product_id, 
        'size'      => $request->size,
        'type'      => $request->type,
        'quantity'  => $request->quantity,
       
    ]);

  return redirect()->route('cart')->with('success', 'Product added to cart successfully!');

}

public function getData(){
    return Cart::all();

}

public function getCheckoutData(){
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
    return view('public.checkout', compact('cartItems'));   

}

    // public function getData(){
    //     return Cart::all();
    // }
 public function index()
{
    if(Auth::check()) {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
    } else {
        $cartItems = Cart::with('product')->where('session_id', Session::getId())->get();
    }
    return view('public.cart', compact('cartItems'));
}

        public function itemRemove($id){
                Cart::findOrFail($id)->delete();
          return response()->json([
        'success' => true
    ]);

        }

  
            public function cartItemCount()
            {
                    if (Auth::check()) {
                        // Logged-in user
                        $count = Cart::where('user_id', Auth::id())->sum('quantity');
                    } else {
                        // Guest user (session_id)
                        $count = Cart::where('session_id', Session::getId())->sum('quantity');
                    }

                    return view('public.partials.navbar', compact('count'));
            }

    // Checkout Functions

    public function checkoutStore(Request $request)
    {
        // Validate checkout form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'payment_method' => 'nullable|string|max:30',
            'discount' => 'nullable|numeric|min:0',
            'shipping' => 'nullable|numeric|min:0',
            'delivery_charges' => 'nullable|numeric|min:0',
            'subtotal' => 'nullable|numeric|min:0',
            'total' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $paymentMethod = $validated['payment_method'] ?? 'COD';

        if (Auth::check()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            $cartItems = Cart::with('product')->where('session_id', Session::getId())->get();
        }

        if ($cartItems->isEmpty()) {
            return back()->withErrors([
                'checkout' => 'Your cart is empty.',
            ]);
        }

        $calculatedSubtotal = $cartItems->sum(function ($item) {
            return ($item->product->price ?? 0) * ($item->quantity ?? 0);
        });

        $discount = (float) ($validated['discount'] ?? 0);
        $shipping = $validated['shipping'] ?? $validated['delivery_charges'] ?? null;
        $shipping = is_null($shipping) ? ($calculatedSubtotal > 4000 ? 0 : 200) : (float) $shipping;
        $subtotal = (float) ($validated['subtotal'] ?? $calculatedSubtotal);
        $totalAmount = (float) ($validated['total_amount'] ?? $validated['total'] ?? ($subtotal + $shipping - $discount));

        DB::transaction(function () use ($validated, $paymentMethod, $subtotal, $shipping, $discount, $totalAmount, $cartItems) {
            $now = now();

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => Auth::check() ? Auth::id() : null,
                'session_id' => Auth::check() ? null : Session::getId(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'customer_name' => $validated['name'],
                'customer_phone' => $validated['phone'],
                'customer_email' => $validated['email'] ?? null,
                'shipping_address' => $validated['address'],
                'shipping_city' => $validated['city'],
                'payment_method' => $paymentMethod,
                'subtotal' => $subtotal,
                'delivery_charges' => $shipping,
                'discount' => $discount,
                'total_amount' => $totalAmount,
                'notes' => $validated['notes'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $orderItems = $cartItems->map(function ($item) use ($orderId, $now) {
                $price = (float) ($item->product->price ?? 0);
                $quantity = (int) ($item->quantity ?? 0);

                return [
                    'order_id' => $orderId,
                    'Cid' => $item->Cid,
                    'product_name_snapshot' => $item->product->product_name ?? 'Unknown Product',
                    'price_snapshot' => $price,
                    'size' => $item->size,
                    'type' => $item->type,
                    'quantity' => $quantity,
                    'line_total' => $price * $quantity,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })->toArray();

            DB::table('order_items')->insert($orderItems);

            // Clear the cart after successful checkout
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                Cart::where('session_id', Session::getId())->delete();
            }
        });

        return redirect()->route('home')->with('success', 'Order placed successfully!');

    }



public function showOrders()
{
    $orders = DB::table('orders')->orderByDesc('id')->paginate(10);
    return view('admin.orders.index', compact('orders'));
}

public function showOrderDetail($id)
{
    $order = DB::table('orders')->where('id', $id)->first();

    if (! $order) {
        abort(404);
    }

    $items = DB::table('order_items')
        ->where('order_id', $id)
        ->orderBy('id')
        ->get();

    return view('admin.orders.show', compact('order', 'items'));
}

public function updateOrderStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:pending,dispatched,completed,cancelled,removed',
    ]);

    $updated = DB::table('orders')
        ->where('id', $id)
        ->update([
            'status' => $validated['status'],
            'updated_at' => now(),
        ]);

    if (! $updated) {
        return back()->withErrors(['status' => 'Order not found.']);
    }

    return back()->with('success', 'Order status updated.');
}

public function restoreOrder($id)
{
    $updated = DB::table('orders')
        ->where('id', $id)
        ->where('status', 'removed')
        ->update([
            'status' => 'pending',
            'updated_at' => now(),
        ]);

    if (! $updated) {
        return back()->withErrors(['status' => 'Removed order not found.']);
    }

    return back()->with('success', 'Order restored and moved back to dashboard.');
}

public function forceDeleteOrder(Request $request, $id)
{
    $order = DB::table('orders')
        ->where('id', $id)
        ->where('status', 'removed')
        ->first();

    if (! $order) {
        return response()->json([
            'success' => false,
            'message' => 'Removed order not found.',
        ], 404);
    }

    DB::transaction(function () use ($id) {
        DB::table('order_items')->where('order_id', $id)->delete();
        DB::table('orders')->where('id', $id)->delete();
    });

    return response()->json([
        'success' => true,
        'message' => 'Order permanently deleted.',
    ]);
}

public function orderHistory()
{
    $orderItemCounts = DB::table('order_items')
        ->select('order_id', DB::raw('COUNT(*) as items_count'))
        ->groupBy('order_id');

    $orders = DB::table('orders')
        ->leftJoinSub($orderItemCounts, 'order_item_counts', function ($join) {
            $join->on('orders.id', '=', 'order_item_counts.order_id');
        })
        ->where('orders.status', 'removed')
        ->select('orders.*', DB::raw('COALESCE(order_item_counts.items_count, 0) as items_count'))
        ->orderByDesc('orders.id')
        ->paginate(20);

    return view('admin.orders.history', compact('orders'));
}
 
}
