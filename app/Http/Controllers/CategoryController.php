<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required',
            'description' => 'required',
        ]);

        $category = new Category();
        $category->name_category = $request->name_category;
        $category->description = $request->description;
        $category->save();

       return response()->json(['success' => 'Category created successfully', 'redirect' => route('categories.index')]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully']);
    }
}
