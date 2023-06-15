<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = Post::class;

     
    public function definition()
    {
        $users = User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($users),
            'title' => $this->faker->sentence(3),
            'body' => implode("\n\n", $this->faker->paragraphs()),
            'post_image' => $this->faker->imageUrl($width = 900, $height = 300)
        ];
    }
}
