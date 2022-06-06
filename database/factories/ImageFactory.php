<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;


class ImageFactory extends Factory
{

    protected $model = Image::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => 'posts/'.$this->faker->image(public_path('storage/posts', 640, 480, null, false))
        ];
    }
}
