<?php

namespace App\Models;

class Post
{
    private static $posts = [
        [
            "judul" => "Artikel 1",
            "slug" => "artikel-1",
            "author" => "Fernandico Geovardo",
            "body" => "
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor animi minima iusto hic ab odit nesciunt ratione autem et rerum optio, numquam nisi voluptatum, vero debitis dolorum saepe exercitationem maxime nihil odio. Iure dolorum aliquid veniam quo sunt ratione repellendus temporibus modi facere nam, hic laboriosam vel dolor explicabo incidunt. Dolorem enim animi beatae. Facere dolorum error dicta fugiat cumque nobis quas ipsam blanditiis aliquid neque hic voluptate, perferendis, itaque placeat quos possimus, iste tempora. Vel fuga enim fugiat quae mollitia iure impedit quasi dolorem, quia, delectus ad. Corporis voluptate placeat eius nulla exercitationem nostrum molestias magnam provident aspernatur qui!"
        ],
        [
            "judul" => "Artikel 2",
            "slug" => "artikel-2",
            "author" => "Abimanyu",
            "body" => "
            Lorem ipsum axime nihil odio. Iure dolorum aliquid veniam quo sunt ratione repellendus temporibus modi facere nam, hic laboriosam vel dolor explicabo incidunt. Dolorem enim animi beatae. Facere dolorum error dicta fugiat cumque nobis quas ipsam blanditiis aliquid neque hic voluptate dolor, sit amet consectetur adipisicing elit. Dolor animi minima iusto hic ab odit nesciunt ratione autem et rerum optio, numquam nisi voluptatum, vero debitis dolorum saepe exercitationem maxime nihil odio. Iure dolorum aliquid veniam quo sunt ratione repellendus temporibus modi facere nam, hic laboriosam vel dolor explicabo incidunt. Dolorem enim animi beatae. Facere dolorum error dicta fugiat cumque nobis quas ipsam blanditiis aliquid neque hic voluptate, perferendis, itaque placeat quos possimus, iste tempora. Vel fuga enim fugiat quae mollitia iure impedit quasi dolorem, quia, delectus ad. Corporis voluptate placeat eius nulla exercitationem nostrum molestias magnam provident aspernatur qui!"
        ]
    ];

    public static function all()
    {
        return collect(self::$posts);
        // karena properti static, jika properti biasa menggunakan this

    }


    public static function find($slug)
    {
        $posts = static::all(); // mengambil semua post dengan static, sehingga bisa mengambil method

        return $posts->firstWhere('slug', $slug);
        // mengambil data yang data slugnya sama dengan slug di parameter
    }
}
