<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Retrieve all users, order by id in descending order, and paginate them
        $users = User::orderBy('id', 'DESC')->paginate(10); // Adjust the number per page as needed
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.index', [
            'users' => $users,
            'categories' => $categories
        ]);
    }


    // Create categories view. 
    public function createCategory()
    {
        // return view('admin.categories.create');
        $categories = Category::all();
        
        return view('admin.categories.create', [
            'categories' => $categories,
        ]);
    }

    // Store categories in the database.
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
    
        $slug = Str::slug($request->name); // Generate slug from category name.
    
        // Check if the generated slug already exists
        if (Category::where('slug', $slug)->exists()) {
            return redirect()->route('admin.categories.create')
                ->withInput($request->all())
                ->withErrors(['slug' => 'The category slug already exists. Please choose a different name.']);
        }
    
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
        ]);
    
        // Redirect to the categories create page with a success message
        return redirect()->route('admin.categories.create')->with('success', 'Category created successfully.');
    }

    // Edit category view.
    public function editCategory($id)
    {
        // Find the category by ID.
        $category = Category::findOrFail($id);
    
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }
    // Update category in the database.
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
    
        $category = Category::findOrFail($id);
    
        // Generate slug from category name and check for uniqueness
        $slug = Str::slug($request->name);
        if (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            return redirect()->route('admin.categories.create', ['category' => $id])
                ->withInput($request->all())
                ->withErrors(['slug' => 'The category slug already exists. Please choose a different name.']);
        }
    
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
        ]);
    
        // Redirect to the categories list or edit page with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Category updated successfully.');
    }

    // Destroy category from the database.
    public function destroyCategory($id)
    {
        // Find the category by ID.
        $category = Category::findOrFail($id);
    
        // Delete the category from the database.
        $category->delete();
    
        // Redirect to the categories create page with a success message.
        return redirect()->route('admin.dashboard')->with('success', 'Category deleted successfully.');
    }

    // Delete user. 
    public function destroyUser($id)
    {
        // Find the user by ID.
        $user = User::findOrFail($id);
    
        // Delete the user from the database.
        $user->delete();
    
        // Redirect to the admin dashboard with a success message.
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    // Edit user view.
    public function editUser($id)
    {
        // Find the user by ID.
        $user = User::findOrFail($id);
    
        return view('admin.users.index', [
            'user' => $user,
        ]);
    }

    // Update user in the database.
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|max:255',
        ]);
    
        $user = User::findOrFail($id);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->role,
        ]);
    
        // Redirect to the admin dashboard with a success message.
        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }
    // Download a user's data as a pdf file.
    public function download($id)
    {
        // Retrieve the authenticated user.
        $user = User::findOrFail($id);
        // Create a new download response with user data as pdf format.
        return response()->download($user, 'user.pdf');
    }

    // Count users API.
    public function countUsers()
    {
        // Count the total number of users in the database.
        $totalUsers = User::count();
    
        // Get the latest user.
        $latestUser = User::orderBy('created_at', 'desc')->first();
    
        // Return the total number of users and the latest user as a JSON response.
        return response()->json([
            'total_users' => $totalUsers,
            'latest_user' => $latestUser
        ]);
    }
}