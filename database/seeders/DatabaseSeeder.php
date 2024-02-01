<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fernandico Geovardo',
            'username' => 'fernandicogeo_',
            'email' => 'fernandico.geovardo01@gmail.com',
            'password' => bcrypt('12345')
        ]);

        User::factory(5)->create();
        // mengenerate 5 data palsu ke table users dengan factory

        Category::create([
            'name' => 'Programming',
            'slug' => 'programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Mobile Application',
            'slug' => 'mobile-application'
        ]);

        Post::factory(25)->create(); // membuat post menggunakan factory



        // User::create([
        //     'name' => 'Abimanyu Andi',
        //     'email' => 'abimanyu@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);


        // Post::create([
        //     'title' => 'Artikel Pertama',
        //     'slug' => 'artikel-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum. Unde, impedit. Blanditiis natus ut doloremque tenetur laborum obcaecati soluta dolore excepturi ullam quia perferendis, odio voluptate? Voluptas eaque officia dicta minus labore distinctio nemo obcaecati veritatis, aut blanditiis praesentium officiis nesciunt provident.</p><p>A aspernatur consequuntur placeat ipsam similique ducimus laudantium eius, ab dolore sed distinctio eveniet doloribus eaque. Consequuntur unde tenetur quaerat non minus commodi dolorem temporibus? Ad, voluptatum sed, ullam inventore doloremque quod minima sapiente, dolores incidunt tempora beatae eum.</p><p>Voluptatum aut tempore exercitationem tempora, blanditiis dicta quidem totam ipsam dolores similique fuga recusandae assumenda. Unde incidunt expedita aspernatur veritatis ipsa eveniet consequuntur neque facilis tenetur tempore explicabo rerum deleniti ab fugiat quaerat iusto corporis officiis ipsam, laudantium maxime dolorum necessitatibus.</p><p>Itaque error ut rerum delectus consequatur consequuntur aperiam tempora sequi, nemo odio autem ducimus qui quos cum alias modi ea libero vitae voluptatem tempore non corrupti quod porro. Similique laborum, sint praesentium deserunt doloribus aliquid id corrupti debitis quo, exercitationem odit aperiam repudiandae facere excepturi pariatur quaerat vitae iste reiciendis iusto corporis commodi esse fugiat! Corrupti temporibus sapiente non magnam vero ratione delectus mollitia, repellat, assumenda, dolorem cupiditate.</p>',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Artikel Kedua',
        //     'slug' => 'artikel-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum. Unde, impedit. Blanditiis natus ut doloremque tenetur laborum obcaecati soluta dolore excepturi ullam quia perferendis, odio voluptate? Voluptas eaque officia dicta minus labore distinctio nemo obcaecati veritatis, aut blanditiis praesentium officiis nesciunt provident.</p><p>A aspernatur consequuntur placeat ipsam similique ducimus laudantium eius, ab dolore sed distinctio eveniet doloribus eaque. Consequuntur unde tenetur quaerat non minus commodi dolorem temporibus? Ad, voluptatum sed, ullam inventore doloremque quod minima sapiente, dolores incidunt tempora beatae eum.</p><p>Voluptatum aut tempore exercitationem tempora, blanditiis dicta quidem totam ipsam dolores similique fuga recusandae assumenda. Unde incidunt expedita aspernatur veritatis ipsa eveniet consequuntur neque facilis tenetur tempore explicabo rerum deleniti ab fugiat quaerat iusto corporis officiis ipsam, laudantium maxime dolorum necessitatibus.</p><p>Itaque error ut rerum delectus consequatur consequuntur aperiam tempora sequi, nemo odio autem ducimus qui quos cum alias modi ea libero vitae voluptatem tempore non corrupti quod porro. Similique laborum, sint praesentium deserunt doloribus aliquid id corrupti debitis quo, exercitationem odit aperiam repudiandae facere excepturi pariatur quaerat vitae iste reiciendis iusto corporis commodi esse fugiat! Corrupti temporibus sapiente non magnam vero ratione delectus mollitia, repellat, assumenda, dolorem cupiditate.</p>',
        //     'category_id' => 1,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'title' => 'Artikel Ketiga',
        //     'slug' => 'artikel-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum. Unde, impedit. Blanditiis natus ut doloremque tenetur laborum obcaecati soluta dolore excepturi ullam quia perferendis, odio voluptate? Voluptas eaque officia dicta minus labore distinctio nemo obcaecati veritatis, aut blanditiis praesentium officiis nesciunt provident.</p><p>A aspernatur consequuntur placeat ipsam similique ducimus laudantium eius, ab dolore sed distinctio eveniet doloribus eaque. Consequuntur unde tenetur quaerat non minus commodi dolorem temporibus? Ad, voluptatum sed, ullam inventore doloremque quod minima sapiente, dolores incidunt tempora beatae eum.</p><p>Voluptatum aut tempore exercitationem tempora, blanditiis dicta quidem totam ipsam dolores similique fuga recusandae assumenda. Unde incidunt expedita aspernatur veritatis ipsa eveniet consequuntur neque facilis tenetur tempore explicabo rerum deleniti ab fugiat quaerat iusto corporis officiis ipsam, laudantium maxime dolorum necessitatibus.</p><p>Itaque error ut rerum delectus consequatur consequuntur aperiam tempora sequi, nemo odio autem ducimus qui quos cum alias modi ea libero vitae voluptatem tempore non corrupti quod porro. Similique laborum, sint praesentium deserunt doloribus aliquid id corrupti debitis quo, exercitationem odit aperiam repudiandae facere excepturi pariatur quaerat vitae iste reiciendis iusto corporis commodi esse fugiat! Corrupti temporibus sapiente non magnam vero ratione delectus mollitia, repellat, assumenda, dolorem cupiditate.</p>',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'title' => 'Artikel Keempat',
        //     'slug' => 'artikel-keempat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum vero voluptates culpa maxime libero at iste, excepturi deleniti rerum. Unde, impedit. Blanditiis natus ut doloremque tenetur laborum obcaecati soluta dolore excepturi ullam quia perferendis, odio voluptate? Voluptas eaque officia dicta minus labore distinctio nemo obcaecati veritatis, aut blanditiis praesentium officiis nesciunt provident.</p><p>A aspernatur consequuntur placeat ipsam similique ducimus laudantium eius, ab dolore sed distinctio eveniet doloribus eaque. Consequuntur unde tenetur quaerat non minus commodi dolorem temporibus? Ad, voluptatum sed, ullam inventore doloremque quod minima sapiente, dolores incidunt tempora beatae eum.</p><p>Voluptatum aut tempore exercitationem tempora, blanditiis dicta quidem totam ipsam dolores similique fuga recusandae assumenda. Unde incidunt expedita aspernatur veritatis ipsa eveniet consequuntur neque facilis tenetur tempore explicabo rerum deleniti ab fugiat quaerat iusto corporis officiis ipsam, laudantium maxime dolorum necessitatibus.</p><p>Itaque error ut rerum delectus consequatur consequuntur aperiam tempora sequi, nemo odio autem ducimus qui quos cum alias modi ea libero vitae voluptatem tempore non corrupti quod porro. Similique laborum, sint praesentium deserunt doloribus aliquid id corrupti debitis quo, exercitationem odit aperiam repudiandae facere excepturi pariatur quaerat vitae iste reiciendis iusto corporis commodi esse fugiat! Corrupti temporibus sapiente non magnam vero ratione delectus mollitia, repellat, assumenda.</p>',
        //     'category_id' => 3,
        //     'user_id' => 1
        // ]);
    }
}
