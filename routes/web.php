<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

//dashboard route with categories. 
Route::get('/dashboard', function () {
    $categories = Category::all();
    return view('dashboard', compact('categories'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Route group for admin users
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware(IsAdmin::class)->name('admin.dashboard');


// Route group for authenticated users 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // edit user route (Laravel Breeze).
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // update user route (Laravel Breeze).
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // delete user route (Laravel Breeze).
    Route::get('/categories/{categoryName}/topics/{id}', [TopicController::class, 'single'])->name('topic.single'); // single topic route.
    Route::get('/categories/{name}',[CategoryController::class, 'single'])->name('category.single'); // single category route.
    Route::post('/topics/{topic_id}/posts', [TopicController::class, 'storePost'])->name('topics.posts.store'); // store post route.
    Route::get('/topics/{topic_id}/delete/post/{post_id}', [TopicController::class, 'destroyPost'])->name('posts.delete'); // delete post route.
    Route::get('/topics/{topic_id}/delete', [TopicController::class, 'destroyTopic'])->name('topics.delete'); // delete topic route.
    Route::get('/topics/{topic_id}/edit', [TopicController::class, 'edit'])->name('topics.edit'); // edit topic route.
    Route::get('/categories/{categoryName}/create', [TopicController::class, 'create'])->name('topics.create'); // Create topic route.
    Route::post('/topics/store/{category_id}', [TopicController::class, 'store'])->name('topics.store'); // Store topic route.

});

require __DIR__.'/auth.php';
