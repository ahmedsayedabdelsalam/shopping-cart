<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use Illuminate\Support\Facades\Storage;
use App\Notifications\NewProduct;
use App\User;
use Illuminate\Support\Facades\Notification;


class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(12);
        $locale = App::getLocale();
        return view('admin.items.items', compact('products', 'locale'));
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
            'description_ar' => 'max:300',
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
        $item->title_ar = $request['title_ar'];
        $item->description_ar = $request['description_ar'];
        $item->price_ar = $request['price_ar'];
        $item->family_id = $request['family'];
        $item->save();
        
        $item->categories()->sync($request['cats']);

        $users = User::all();
        Notification::send($users, new NewProduct($item));
        
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
        $product = Product::findOrFail($id);
        $locale = App::getLocale();
        return view('admin.items.item', compact('product', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
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

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:300',
            'description_ar' => 'max:300',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image')) {
            if($item->imagePath != 'default.jpg') {
                $oldImagePath = 'public/product_images/' . $item->imagePath;
                Storage::delete($oldImagePath);
            }
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/product_images', $filename);
            $item->imagePath = $filename;
        }
    
        $item->title = $request['title'];
        $item->description = $request['description'];
        $item->price = $request['price'];
        $item->title_ar = $request['title_ar'];
        $item->description_ar = $request['description_ar'];
        $item->price_ar = $request['price_ar'];
        $item->family_id = $request['family'];
        $item->save();

        $item->categories()->sync($request['cats']);

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
        if($item->imagePath != 'default.jpg') {
            $oldImagePath = 'public/product_images/' . $item->imagePath;
            Storage::delete($oldImagePath);
        }
        $item->delete();
        return redirect()->back()->with('alert-info', 'item deleted successfully');
    }
}
