<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AttachFilesTrait;

    public function index()
    {
        $products = Product::get();
        $categories = Category::get();
        return view('pages.product.index', compact('products', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = Category::get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error fetching categories');
        }
        return view('pages.product.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->file('image')->getClientOriginalName(),
            'price' => $request->price,
            'descount_price' => $request->descount_price,
            'category_id' => $request->category_id
        ]);
        $this->uploadFile($request, 'image', 'upload_attachments');
        return redirect()->route('products')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customers = Customer::all();
        $categories = Category::all();
        $products = Product::find($id);
        return view('Home.product-detail', compact('products', 'categories', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('pages.product.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::find($request->id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'descount_price' => $request->descount_price,
        ]);
        if ($request->hasFile('image')) {
            $this->deleteFile($product->image);

            $this->uploadFile($request, 'image', 'upload_attachments');
            $image_new = $request->file('image')->getClientOriginalName();
            $product->image = $product->image !== $image_new ? $image_new : $product->image;
        }

        return redirect()->route('products');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->deleteFile($request->file_name);
        $product = Product::find($request->id);
        $product->destroy($request->id);
        return redirect()->back()->with(['success' => 'Product Delete']);
    }

    public function showCartCustomer($id)
    {
        $product = Product::find($id);
        return view('Home.cart', [
            'product' => $product,
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
}
