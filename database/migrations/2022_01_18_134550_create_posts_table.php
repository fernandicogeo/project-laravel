<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id'); // menghubungkan tabel posts dengan tabel categories
            $table->foreignId('user_id'); // menghubungkan tabel posts dengan tabel users
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->text('excerpt');
            $table->text('body');
            $table->timestamp('published_at')->nullable(); // timestamp
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
