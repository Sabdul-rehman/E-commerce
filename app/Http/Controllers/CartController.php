<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;       
use Illuminate\Support\Facades\Session;    
use Illuminate\Http\Request;

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

    return redirect()->back()->with('success', 'Added to cart');
}

    public function getData(){
        return Cart::all();
    }
    public function index()
    {
        $cartItems = Cart::with('product')->get();
        return view('public.cart', compact('cartItems'));

    }


}
