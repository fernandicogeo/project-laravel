<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login Page'
        ];
        return view('login/index', $data);
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // jika login berhasil
        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate(); // menghindari teknik hacking
            return redirect()->intended('/dashboard');
        }

        // jika login gagal
        return back()->with('loginFailed', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
