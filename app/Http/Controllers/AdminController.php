<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'categories' => $categories,
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
            'admin_only' => 'string|max:255',
        ]);

        // Log the incoming data for debugging
        Log::info('Category Create Request Data:', [
            'name' => $request->name,
            'description' => $request->description,
            'admin_only' => $request->admin_only, // Logs whether the checkbox was checked or not
        ]);

        $slug = Str::slug($request->name); // Generate slug from category name.

        // Check if the generated slug already exists
        if (Category::where('slug', $slug)->exists()) {
            return redirect()->route('admin.categories.create')
                ->withInput($request->all())
                ->withErrors(['slug' => 'The category slug already exists. Please choose a different name.']);
        }
        Log::info('Inserting category: '.json_encode([
            'name' => $request->name,
            'description' => $request->description,
            'admin_only' => $request->admin_only,
        ]));

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'admin_only' => $request->admin_only,
        ]);

        // Now update admin_only if needed
        if ($request->admin_only == 1) {
            //Log
            Log::info('Updating category to admin_only: '.json_encode([
                'admin_only' => $request->admin_only,
            ]));
        } else {
            //Log
            Log::info('Not updating category to admin_only');
        }

        return redirect()->route('admin.categories.create')->with('success', 'Category created successfully.');
    }

    // Edit category view.
    public function editCategory($id)
    {
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
            'admin_only' => 'string|max:255',
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
            'admin_only' => $request->has('admin_only'),
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
        // Check if the user is an admin.
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->withErrors('You cannot delete an admin user.');
        } else {
            try {
                $user->delete();

                return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
            } catch (\Exception $e) {
                return redirect()->route('admin.dashboard')->withErrors('An error occurred while deleting the user.');
            }
        }
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

    public function download($id)
    {
        // Retrieve the user data.
        $user = User::findOrFail($id);

        // Generate the PDF using the user data.
        $pdf = app(PDF::class);
        $pdf->loadView('pdf.user', compact('user'));

        // Save the PDF to a temporary location (optional, for download response).
        $tempFile = storage_path('app/public/user_'.$user->id.'.pdf');
        $pdf->save($tempFile);

        // Return the PDF as a downloadable file.
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }

    // Count users API.
    public function countUsers()
    {
        // Count the total number of users in the database.
        $totalUsers = User::count();

        // Retrieve the latest user.
        $latestUser = User::latest()->first(['name']);

        // Return the total number of users and the name of the latest user as a JSON response.
        return response()->json([
            'total_users' => $totalUsers,
            'latest_user' => $latestUser ? $latestUser->name : null,
        ]);
    }
}
