<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [ // membuat factory sendiri
            'title' => $this->faker->sentence(mt_rand(1, 4)), // fungsi mt_rand(1, 4) untuk merandom, minimal 1 kata dan maksimal 4 kata
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(3, 5))) . '<p>',
            'user_id' => mt_rand(1, 5),
            'category_id' => mt_rand(1, 3)
        ];
    }
}
