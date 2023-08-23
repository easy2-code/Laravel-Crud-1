<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // First way 
        // $products= Product::get();
        // return view('products.index', ['products'=>$products]);

        // second way 
        // return view('products.index',['products'=>Product::get()]);
        // if we want to get the latest product on top that we add so just add ::latest() in the above code
        // to paginate add paginate(5) instead of get() in the below code 
        // paginate means how many products we want to show on the first page
        return view('products.index',['products'=>Product::latest()->paginate(5)]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        // validate data 
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpeg,png,gif|max:10000'
        ]);
        

        // upload image 
        $imageName=time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);
        $product=new Product;
        $product->image=$imageName;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->save();
        return back()->withSuccess('Product Created !!!!');
    }
    public function edit($id)
    {
        $product=Product::where('id', $id)->first();
        return view('products.edit', ['product'=>$product]);
    }
    public function update(Request $request, $id)
    {
        // validate data 
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            // user may not change image always that's why we put nullable 
            'image'=>'nullable|mimes:jpeg,png,gif|max:10000'
        ]);
        
        $product=Product::where('id', $id)->first();
        // if user want to change image 
        if(isset($request->image))
        {
            // upload image 
            $imageName=time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image=$imageName;
        }
        $product->name=$request->name;
        $product->description=$request->description;
        $product->save();
        return back()->withSuccess('Product Updated !!!!');
    }

    // This is through get method to delete product but laravel says to use delete method 
    // The belove code is for get method 
    // // See get Route in web.php 
    // public function destroy($id)
    // {
    //     $Product=Product::where('id', $id)->first();
    //     $Product->delete();
    //     return back()->withSuccess('Product Deleted !!!!');
    // }
    public function destroy($id)
    {
        $product=Product::where('id', $id)->first();
        $product->delete();
        return back()->withSuccess('Product Deleted !!!!');
    }

    // To show the product when user click on product name 
    public function show($id)
    {
        $product=Product::where('id', $id)->first();
        return view('products.show', ['product'=>$product]);
    }
}