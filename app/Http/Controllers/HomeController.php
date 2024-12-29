<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products = Product::paginate(25);
        return view('welcome', compact('products'));
    }
    public function shop(){
        $products = Product::paginate(25);
        return view('shop',compact('products'));
    }

    public function contact(){
        return view('contact');
    }
    public function about(){
        return view('about');
    }
    public function product($id){
        $product = Product::findorFail($id);
        return view('product', compact('product'));
    }
    public function message(){
        Message::create([
            "name"=>request('name'),
            "message"=>request('message'),
            "email"=>request('email'),
            "phone_number"=>request('phone_number'),
            "status"=>"pending"
        ]);
        return back()->with('success', 'Message sent successfully');
    }
}
