<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category')); // ambil data di database, dimana slugnya sama dengan request
            $title = ' in ' . $category->name;
        }

        if (request('user')) {
            $user = User::firstWhere('username', request('user')); // ambil data di database, dimana slugnya sama dengan request
            $title = ' in ' . $user->name;
        }

        // $posts = Post::all();
        $posts = Post::with(['user', 'category'])->latest(); // yang terakhir dimasukkan akan dipost dipaling atas
        // menggunakan with() sehingga tidak perlu memanggil query secara berulang-ulang, jika memanggil db nya tidak menggunakan routes model bainding

        $data = [
            "title" => "All Posts" . $title,
            "posts" => $posts->search(request(['search', 'category', 'user']))->paginate(7)->withQueryString()
            // paginate untuk membagi beberapa postingan ke beberapa page
            // withQueryString untuk membawa query dari page sebelumnya
        ];
        return view('posts', $data);
    }

    public function show(Post $post) // variabel penerima harus sama dengan variabel pengirim dari Routes
    {
        $post = $post;
        $data = [
            "title" => "Single Post",
            "post" => $post
        ];
        return view('post', $data);
    }
}
