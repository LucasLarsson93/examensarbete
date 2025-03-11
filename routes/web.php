<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\UpdateLastActivity;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/favicon.ico', function () {
    return response()->file(public_path('favicon.ico'));
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// dashboard route with categories.
Route::get('/dashboard', function () {
    $categories = Category::all();

    return view('forum.dashboard.index', compact('categories'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/online-users', function () {
    $users = DB::table('users')->where('is_online', 1)->get();
    $usernames = [];

    foreach ($users as $user) {
        $backgroundColor = $user->is_admin ? 'bg-red-600' : 'bg-gray-600';
        $usernames[] = '<span class="' . $backgroundColor . ' text-white font-bold px-2 py-1 rounded">' . $user->name . '</span>';
    }

    return response()->json(['users' => $usernames, 'no_users' => empty($usernames)]);
});

// Public routes.
Route::get('/categories/announcement', [CategoryController::class, 'index'])->name('categories.index');
//Route for privacy policy
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');
//Route for terms of service
Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms-of-service');
//Route for shop
Route::get('/shop', function () {
    return view('shop');
})->name('shop');
// Route group for admin users.
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/admin/categories/store', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/admin/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::patch('/admin/categories/{id}/update', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/admin/categories/{id}/delete', [AdminController::class, 'destroyCategory'])->name('categories.delete');
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/users/{id}/delete', [AdminController::class, 'destroyUser'])->name('users.delete'); // Delete user route.
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit'); // Edit user view.
    Route::patch('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('users.update'); // Update user route.
    // Download a user's data in json format.
    Route::get('/admin/users/{id}/download', [AdminController::class, 'download'])->name('users.logs');
    //users.index to search for users in table.
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
});

// Route group for authenticated users.
Route::middleware(['auth', UpdateLastActivity::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/download', [ProfileController::class, 'download'])->name('profile.download');
    Route::get('/categories/{categoryName}/topics/{id}', [TopicController::class, 'single'])->name('topic.single');
    Route::post('/generate-speech', [TopicController::class, 'generateSpeech'])->name('topic.generateSpeech');
    Route::get('/categories/{slug}', [CategoryController::class, 'single'])->name('category.single');
    Route::post('/topics/{topic_id}/posts', [PostController::class, 'storePost'])->name('topics.posts.store');
    Route::get('/topics/{topic_id}/delete/post/{post_id}', [PostController::class, 'destroyPost'])->name('posts.delete');
    Route::get('/topics/{topic_id}/delete', [TopicController::class, 'destroyTopic'])->name('topics.delete');
    Route::get('/topics/{topic_id}/edit/post/{post_id}', [PostController::class, 'editPost'])->name('topics.editPost');
    Route::get('/topics/{topic_id}/edit', [TopicController::class, 'editTopic'])->name('topics.editTopic');
    Route::get('/categories/{categoryName}/topics/{id}/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/topics/{categoryName}/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/topics/store/{category_id}', [TopicController::class, 'store'])->name('topics.store');
    Route::patch('/topics/{topic_id}/update', [TopicController::class, 'update'])->name('topics.update');
    Route::patch('/topics/{topic_id}/update/post/{post_id}', [PostController::class, 'updatePost'])->name('posts.update');
    Route::get('/users/{id}', [ProfileController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/topics', [ProfileController::class, 'loadMoreTopics'])->name('users.topics');
    Route::get('/inbox', [ProfileController::class, 'inbox'])->name('inbox');
});

// Route API to count users within the UsersController
Route::get('/api/users/count', [AdminController::class, 'countUsers'])->name('users.count');
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

require __DIR__.'/auth.php';
