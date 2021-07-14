<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNotNull('category_id')->get();
        return view('admin.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $ext = $image->extension();
        $fileName = time() . '.' . $ext;

        //$image->move('uploads/productimg',$fileName);
        $image->move(public_path('post'), $fileName);
        $data = array(
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $fileName

        );


        $create = Product::create($data);

        return redirect()->route('product.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $categories = Category::whereNotNull('category_id')->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $id = $request->id;
        $data = array(
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,


        );
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = date('dmY') . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post'), $fileName);
            $date['image'] = $fileName;
        }
        $create = Product::where('id', $id)->update($data);
        return redirect()->route('product.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return back();
    }
    public function extraDetails(Request $request)
    {
      //  $arr['id'] =  $request->id;
      $id=$request->id;
       $product=Product::where('id',$id)->with('ProductDetails')->first();

        return view('admin.product.extraDetails', compact('id','product'));
    }

    public function extraDetailsStore(Request $request)
    {
        $id=$request->id;
        $data = array(
            'title' => $request->title,
            'product_id' => $id,
            'total_items' => $request->total_items,
            'description' => $request->description
        );
       // dd($data);
        ProductDetails::updateOrCreate(
            ['product_id'=>$id],
            $data);
        return redirect()->route('product.list');
    }
}
