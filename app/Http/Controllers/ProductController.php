<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // Validate the request
        $val=Validator::make(request()->input(), [
            'name' =>'required|string|max:255',
            'description' =>'required|string',
            'price' =>'required|numeric',
            'category'=>'required|string',
            'units'=>'required|numeric',
            'cover'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($val){
            if(request()->hasFile('cover')){
                $coverImage = request()->file('cover');
                $coverImageName = time(). '.'. $coverImage->getClientOriginalExtension();
                $path=$coverImage->move('storage/uploads/products', $coverImageName);
                Product::create([
                    'name' => request('name'),
                    'description' => request('description'),
                    'price' => request('price'),
                    'category'=>request('category'),
                    'units'=>request('units'),
                    'isAvailable' => true,
                    'cover' => $path
                ]);
                return redirect()->route('products.index')->with('success', 'Product created successfully!');
            }
        }
        return redirect()->back()->with('error', 'Failed to create product, please try again!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('dashboard.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
