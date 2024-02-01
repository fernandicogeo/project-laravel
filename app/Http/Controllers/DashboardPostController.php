<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
            'title' => 'Dashboard Posts'
            // mengambil data post yang ditulis oleh user yang sedang login
        ];
        return view('dashboard.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::all(), // menginclude seluruh category agar bisa dimasukkan di select
            'title' => 'Create Post'
        ];
        return view('dashboard.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload file ke folder post-images di storage/app/public, karena envnya kita ubah dari local ke public
        // fungsi ini mengembalikan path
        $photo = $request->file('image');
        // return $photo->store('post-images');
        $data = getimagesize($photo);
        $width = $data[0];
        $height = $data[1];

        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required', // mengapa harus category_id, agar bisa dikirim ke table posts
            'image' => 'image|file|max:2048', // max 2 mb
            'body' => 'required'
            // masih kurang 2, yaitu user_id dan excerpt
        ];

        // memvalidasi data $rules
        $validatedData = $request->validate($rules);

        if ($photo) { // jika photo diupload
            $validatedData['image'] = $photo->store('post-images'); // simpan foto ke folder post-image
        }

        // memasukkan user_id
        $validatedData['user_id'] = auth()->user()->id;

        // memasukkan excerpt
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200)); // memotong body menjadi 200 huruf pertama, dilanjutkan dengan "..."

        // memasukkan width dan height
        $validatedData['width'] = $width;
        $validatedData['height'] = $height;

        // insert data ke db
        Post::create($validatedData);

        // redirect ke halaman posts
        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = [
            'post' => $post,
            'title' => "My Post"
        ];
        return view('dashboard.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            'post' => $post,
            'categories' => Category::all(),
            'title' => 'Edit Post'
        ];
        return view('dashboard.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];

        $photo = $request->file('image');

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        // karena jika tidak dibuat perkondisian, slug setelah diupdate (slug tidak diganti) akan eror, karena di db sudah ada

        $validatedData = $request->validate($rules); // memvalidasi data, sama seperti store tapi dirapihkan

        if ($photo) { // jika photo diupload
            $validatedData['image'] = $photo->store('post-images'); // simpan foto ke folder post-image
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200));

        // update data ke db
        Post::where('id', $post->id)
            ->update($validatedData);

        // redirect ke halaman posts
        return redirect('/dashboard/posts')->with('success', 'New post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // menghapus data di db bedasarkan id
        Post::destroy($post->id);

        // redirect ke halaman posts
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request) // agar ketika mengisikan title, slug otomatis terisi
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
