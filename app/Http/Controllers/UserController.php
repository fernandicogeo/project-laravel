<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function show(User $user) // variabel penerima harus sama dengan variabel pengirim dari Routes
    {
        return view('posts', [
            'title' => "$user->name's Posts",
            'posts' => $user->posts->load('category', 'user')
            // menggunakan load() sehingga tidak perlu memanggil query secara berulang-ulang, load() digunakan ketika memakai routes model bainding
        ]);
    }
}
