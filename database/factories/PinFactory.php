<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$width = mt_rand(450, 900);
		$height = mt_rand(350, 900);
        return [
			'title' => $this->faker->text(),
			'user_id' => \App\Models\User::inRandomOrder()->value('id'),
			'image' => $this->faker->imageUrl($width, $height),
			'width' => $width,
			'height' => $height,
        ];
    }

}
