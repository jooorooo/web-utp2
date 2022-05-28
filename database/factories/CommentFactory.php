<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'comment' => $this->faker->text(),
			'user_id' => \App\Models\User::inRandomOrder()->value('id'),
			'pin_id' => \App\Models\Pin::inRandomOrder()->value('id'),
        ];
    }

}
