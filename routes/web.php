<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

Route::get('/', [BlogController::class,'index']);

// Route::get('/blogs/{blog}',function($id)
Route::get('/blogs/{blog:slug}',[BlogController::class,'show']);


// Route::get('/categories/{category:slug}',function(Category $category){
    
//     return view('blogs',[
//         // 'blogs'=>$category->blogs->load('author','category')
//         'blogs'=>$category->blogs,
//         'categories'=>Category::all(),
//         'currentCategory'=>$category
//     ]);
// });

// Route::get('/users/{user:username}',function(User $user){
    
//     return view('blogs',[
//         // 'blogs'=>$user->blogs->load('author','category')
//         'blogs'=>$user->blogs,
//         // 'categories'=>Category::all()
//     ]);
// });

Route::post('/blogs/{blog:slug}/comments',[CommentController::class,'store']);

Route::get('/register', [AuthController::class,'create'])->middleware('guest');
Route::post('/register', [AuthController::class,'store'])->middleware('guest');
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth');

Route::get('/login', [AuthController::class,'login'])->middleware('guest');
Route::post('/login', [AuthController::class,'post_login'])->middleware('guest');

Route::post('/blogs/{blog:slug}/subscription',[BlogController::class,'subscriptionHandler']);


//Admin Route
Route::get('/admin/blogs/create',[BlogController::class,'create'])->middleware('admin');
Route::post('/admin/blogs/store',[BlogController::class,'store'])->middleware('admin');


