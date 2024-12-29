<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\POrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class POrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin) {
            $orders = POrder::all();
        } else {
            $orders = POrder::where('user_id', Auth::id())->get();
        }
        return view('dashboard.orders.index', compact('orders'));
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
        // try {
        $user = Auth::user()->name;
        $name = explode(" ", $user);
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $receipt = strtoupper((uniqid()));
        foreach ($cart as $item) {
            POrder::create([
                'user_id' => Auth::user()->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'receipt_no' => $receipt
            ]);
            Cart::destroy($item->id);
        }
        return view('checkout', compact('name'))->with('success', 'Order placed successfully!');
        // } catch (\Throwable $th) {
        //     // throw $th;
        //     return redirect()->route('orders.index')->with('error', 'An error occurred while placing the order!');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(POrder $pOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(POrder $pOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $order = POrder::find($id);
        if(request("isDelivered")!=''){
            $order->isDelivered=request("isDelivered");
        }
        if(request("delivery_date")!=''){
            $order->delivery_date=request("delivery_date");
        }
        if(request("isPaid")!=''){
            $order->isPaid=request("isPaid");
        }
        $order->update();
        return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(POrder $pOrder)
    {
        //
    }
}
