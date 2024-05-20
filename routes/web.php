<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

//dashboard route with categories. 
Route::get('/dashboard', function () {
    $categories = Category::all();
    return view('forum.dashboard.index', compact('categories'));
})->middleware(['auth', 'verified'])->name('dashboard');


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
});


// Route group for authenticated users.
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // edit user route (Laravel Breeze).
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // update user route (Laravel Breeze).
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // delete user route (Laravel Breeze).
    Route::get('/profile/download', [ProfileController::class, 'download'])->name('profile.download'); // Download your data in json format.
    Route::get('/categories/{categoryName}/topics/{id}', [TopicController::class, 'single'])->name('topic.single'); // single topic route.
    Route::get('/categories/{slug}',[CategoryController::class, 'single'])->name('category.single'); // single category route.
    Route::post('/topics/{topic_id}/posts', [PostController::class, 'storePost'])->name('topics.posts.store'); // store post route.
    Route::get('/topics/{topic_id}/delete/post/{post_id}', [PostController::class, 'destroyPost'])->name('posts.delete'); // delete post route.
    Route::get('/topics/{topic_id}/delete', [TopicController::class, 'destroyTopic'])->name('topics.delete'); // delete topic route.
    Route::get('/topics/{topic_id}/edit/post/{post_id}', [PostController::class, 'editPost'])->name('topics.editPost'); // edit post route.
    Route::get('/topics/{topic_id}/edit', [TopicController:: class, 'editTopic'])->name('topics.editTopic'); // edit topic route.
    Route::get('/categories/{categoryName}/topics/{id}/create', [PostController::class, 'create'])->name('posts.create'); // Create post route.
    Route::get('/topics/{categoryName}/create', [TopicController::class, 'create'])->name('topics.create'); // Create topic view.
    Route::post('/topics/store/{category_id}', [TopicController::class, 'store'])->name('topics.store'); // Store topic route.
    Route::patch('/topics/{topic_id}/update', [TopicController::class, 'update'])->name('topics.update'); // Update topic route.
    Route::patch('/topics/{topic_id}/update/post/{post_id}', [PostController::class, 'updatePost'])->name('posts.update'); // Update post route.

});

require __DIR__.'/auth.php';
