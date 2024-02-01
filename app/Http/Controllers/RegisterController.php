<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('register/index', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([ // memvalidasi data
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']); // bisa juga memakai Hash::make

        User::create($validatedData); // memasukkan data ke db

        // $request->session()->flash('success', 'Registration successfull! Please login.');
        // sama
        return redirect('/login')->with('success', 'Registration successfull! Please login.');
    }
}
