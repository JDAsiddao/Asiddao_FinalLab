<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $softDeletedCategories = Category::onlyTrashed()->get(); // Retrieve soft-deleted categories
        return view('admin.category.category', compact('categories', 'softDeletedCategories'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateCategory($request);

        // Handle image upload
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
            $data['category_image'] = $imagePath;
        }

        $data['user_id'] = Auth::id();
        $data['created_at'] = now();

        Category::create($data);

        return redirect()->route('AllCat');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateCategory($request);

        // Handle image update
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
            $data['category_image'] = $imagePath;
        }

        $category = Category::findOrFail($id);
        $category->update($data);

        return redirect()->route('AllCat');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('AllCat');
    }

    private function validateCategory(Request $request)
    {
        return $request->validate([
            'category_name' => 'required|string',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('AllCat')->with('status', 'Category restored successfully.');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('AllCat')->with('status', 'Category permanently deleted.');
    }
}

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }
}
