<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'refrence_code' => $this->faker->randomDigit(),
            'title' => $this->faker->word(),
            'category_id' => $this->faker->numberBetween($min = 0, $max = 9),
            'image' => $this->faker->imageUrl($width = 640, $height = 480, 'cats'),
            'year'=> $this->faker->year($max = 'now')
        ];
    }
}
