<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $products = Category::get();
        return view('Home.index',compact('products'));
    }

    public function selection(){
        return view('auth.selection');
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Home.cart',[
            'product'=>Product::all(),
            'categories'=>Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categories=Category::find($id);
        return view('Home.product-detail',[
            'category'=>$categories,
        ]);
        // $categories = Category::findOrFail($id);
        // return view('Home.product-detail',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}
