<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "About's Page",
            "name" => "Fernandico Geovardo",
            "email" => "fernandico.geovardo01@gmail.com",
            "image" => "fernandico.jpg"
        ];
        return view('about', $data);
    }
}
