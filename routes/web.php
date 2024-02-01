<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/
// HOME
Route::get('/', [HomeController::class, 'index']);

// ABOUT
Route::get('/about', [AboutController::class, 'index']);

// POSTS
Route::get('/posts', [PostController::class, 'index']);

// SINGLE POST
Route::get('/post/{post:slug}', [PostController::class, 'show']);
// slug yg diquery untuk mendapatkan artikel yg dicari

// CATEGORIES
Route::get('/categories', [CategoryController::class, 'index']);

// SINGLE CATEGORY 
// Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

// SINGLE USER (DAFTAR POST YANG DIBUAT OLEH 1 USER) 
// Route::get('/users/{user:username}', [UserController::class, 'show']);

// tidak terpakai karena sudah ditangani di model Post

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); // hanya boleh diakses oleh user yang belum ter autentifikasi/login
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']); //logout

// REGISTER
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']); // menyimpan data

// agar ketika mengisikan title, slug otomatis terisi pada create post
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

// DASHBOARD POSTS (menghandle semua routes pada dashboard posts)
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// DASHBOARD
//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth'); // hanya boleh diakses oleh user yang sudah ter autentifikasi/login
Route::resource('/dashboard', DashboardUserController::class)->middleware('auth');
Route::get('/dashboard/{user:username}/change', [DashboardUserController::class, 'change'])->middleware('auth');
Route::post('/dashboard/{user:username}', [DashboardUserController::class, 'updatepass'])->middleware('auth');

// note :
// jika user ke halaman /dashboard/posts dengan method GET, maka akan menggunakan method index()
// jika user ke halaman /dashboard/posts dengan method POST, maka akan menggunakan method store()
// jika user ke halaman /dashboard/posts dengan method PUT, maka akan menggunakan method update()
// jika user ke halaman /dashboard/posts dengan method DELETE, maka akan menggunakan method destroy()
// jika user ke halaman /dashboard/posts/create, maka akan menggunakan method create()
// jika user ke halaman /dashboard/posts/{{ $post->slug }}, maka akan menggunakan method show()
// jika user ke halaman /dashboard/posts/{{ $post->slug }}/edit, maka akan menggunakan method edit()

// CEK ROUTE RESOURCE : 'php artisan route:list'
