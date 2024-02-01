<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    // protected $fillable = ['title', 'slug', 'excerpt', 'body'];
    // agar bisa diisi secara sekaligus di terminal

    protected $guarded = ['id'];
    // tidak bisa diisi dan diupdate


    // SEARCHING (ditangani disini)
    public function scopeSearch($query, array $searches)
    {
        $query->when($searches['search'] ?? false, function ($query, $search) // jika $searches['search'] ada, maka jalankan function, jika tidak ada, maka return false
        // parameter $query diambil dari $query, parameter $search diambil dari $searches['search']
        {
            // SEARCHING POSTINGAN
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%') // cari judul yang sama dengan keyword yg diketik di search
                    ->orWhere('body', 'like', '%' . $search . '%'); // cari teks dalam body yang sama dengan keyword yg diketik di search
            });
        });

        // SEARCHING POSTINGAN DIDALAM CATEGORY
        $query->when($searches['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) { // whereHas untuk menghubungkan dengan table lain
                $query->where('slug', $category);
            });
        });

        // SEARCHING POSTINGAN DIDALAM USER
        // versi ARROW FUNCTION, MENGGUNAKAN => DAN TIDAK PERLU USE () KARENA VARIABEL PARAMETERNYA SUDAH GLOBAL
        $query->when(
            $searches['user'] ?? false,
            fn ($query, $user) =>
            $query->whereHas(
                'user',
                fn ($query) =>
                $query->where('username', $user)
            )
        );

        // VERSI CALLBACK FUNCTION
        // $query->when($searches['user'] ?? false, function ($query, $user) {
        //     return $query->whereHas('user', function ($query) use ($user) {
        //         $query->where('username', $user);
        //     });
        // });
    }


    public function category() // nama method sama dgn nama model
    {
        return $this->belongsTo(Category::class);
        // menghubungkan model post dengan model category, dimana satu post hanya dimiliki oleh satu category
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug'; // agar setiap routes pada post selalu mencari slug, bukan ID
    }

    // template agar ketika mengisikan title, slug otomatis terisi
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
