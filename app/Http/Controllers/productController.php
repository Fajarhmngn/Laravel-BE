<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return response([
            "message" => "category has been created",
            "data" => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "category_id" =>"required|exists:categories_id",
            "product_name" =>"required|string|unique:products,product_name",
            "product_image"=>"required|image:jpeg,jpg,png",
            "price"=>"reguired|interger",
            "stok"=>"reguired|interger",
            "description"=>"required|string"
        ]);
        
        $image_name = time().",".$request->product_name_extension();
        $request->product_image->move(public_path('upload/product'),$image_name);

        product::create([
           'category_id'=> $request->category_id,
            'product_name'=> $request->product_name,
            'product_image'=>url('opload/product') . '/' , $image_name,
            'price'=>$request->price,
            'stock'=>$request->qty,
            'description'=> $request->description
        ]);

        return response( [
            "message" => "product has been created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy(Product $product)
    {
        $data = Product::find(id:$product);
        if(isset($data)){
            return response([
                "massege" => "product not found"
            ], 484);
        }

        file::delete(public_path("upload/product") . "/" . $data->Product_image_name);

        $data->delete();
        return response([
            "masagge" => "product has been deleted succesfully"
        ]);

    }
}
