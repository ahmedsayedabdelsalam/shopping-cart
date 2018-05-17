<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use Illuminate\Support\Facades\Storage;


class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.items.items', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.items.create-item');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $item = new Product();
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:300',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/product_images', $filename);
            $item->imagePath = $filename;
        }
    
        $item->title = $request['title'];
        $item->description = $request['description'];
        $item->price = $request['price'];
        $item->save();

        return redirect()->back()->with('alert-info', 'item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.items.item', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.items.edit-item', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item= Product::find($id);
        $oldImagePath = 'public/product_images/' . $item->imagePath;

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:300',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/product_images', $filename);
            Storage::delete($oldImagePath);
            $item->imagePath = $filename;
        }
    
        $item->title = $request['title'];
        $item->description = $request['description'];
        $item->price = $request['price'];
        $item->save();

        return redirect()->back()->with('alert-info', 'item edited successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::find($id);
        $item->delete();
        return redirect()->back()->with('alert-info', 'item deleted successfully');
    }
}
