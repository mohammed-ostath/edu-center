<?php

namespace App\Http\Controllers\Category;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AttachFilesTrait;
    public function index()
    {
        $categories = Category::get();
        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'  => 'required|unique:categories|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
        ]);

        $categories = Category::create([
            'name' => $request->name,
            'image' => $request->file('image')->getClientOriginalName(),
        ]);
        $this->uploadFile($request, 'image', 'upload_attachments');
        return redirect()->route('categories')->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('categories')->with('error', 'category not found');
        }
        return view('pages.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $categories = Category::find($request->id);
        $categories->update([
            'name' => $request->name
        ]);

        if ($request->hasFile('image')) {
            $this->deleteFile($categories->image);

            $this->uploadFile($request, 'image', 'upload_attachments');
            $image_new = $request->file('image')->getClientOriginalName();
            $categories->image = $categories->image !== $image_new ? $image_new : $categories->image;
        }
        return redirect()->route('categories')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->deleteFile($request->file_name);
        $categories=Category::find($request->id);
        $categories->destroy($request->id);
        return redirect()->back();
    }
}
