<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data = Product::with('category')->ger();
        return view('admin.product.index', compact('data'));
    }

    public function create(){
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'body' => 'required', 
            'image' => 'required|image|mimes:jpg,jpng,jpeg'
        ]);
        $request->image->move(public_path('image',$image_file));

        return redirect()->route('admin.product.index')->with('success', 'New Product Hass Ben Added');
    }

    public function edit($id){
        $category = Category::all();
        $data = Product::findorfail($id);
        return view('admin.product.edit', compact('data', 'category'));
    }

    public function update(Request $request, $id){
        $data = Product::find($id);
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'body' => 'required',
        ]);
        $data->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => str_replace(' ','-',$request->title),
            'harga' => $request->harga,
            'body' => $request->body,
        ]);
    
        return redirect()->route('admin.product.index')->with('success', 'Product Hass Been Deleted');
    }

    public function destroy($id){
        $data = Product::find($id);
        unlink(public_path('image/'.$data->image));
        $data->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product Hass Been Deleted');
    }
}
