<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Cart::where('user_id', Auth::user()->id)->get();
        $sum=Cart::where('user_id',Auth::user()->id)->join('products', 'carts.product_id', '=', 'products.id')
        ->selectRaw('SUM(carts.quantity * products.price) as total')
        ->value('total');
        // return $sum;
        return view('cart', compact('products','sum'));
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
    public function store()
    {
        $cart=Cart::where([['product_id',request('product_id')],['user_id',Auth::user()->id]])->first();
        if(!$cart){
            Cart::create([
                "user_id"=>Auth::user()->id,
                "product_id"=>request('product_id'),
                "quantity"=>request('quantity'),
            ]);
        }else{
            $cart->quantity+=request('quantity');
            $cart->update();
        }
        return back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products = Cart::findOrFail($id);
        return view('cart', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
