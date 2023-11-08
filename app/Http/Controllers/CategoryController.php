<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User; // Import the User model at the top of your controller.
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'category_name' => 'required|string',
    ]);

    // Set the user_id to the authenticated user's ID
    $data['user_id'] = Auth::id();

    // Set the created_at timestamp
    $data['created_at'] = now(); // You may need to format this date as needed

    Category::create($data);

    return redirect()->route('AllCat');
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
