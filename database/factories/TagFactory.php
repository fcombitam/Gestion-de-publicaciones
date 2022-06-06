<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagFactory extends Factory
{

    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word(20);
        return [
            'name' => $name,
            'slug'=> Str::slug($name),
            'color'=> $this->faker->randomElement(['red','yellow','green','blue','indigo','purple','pink'])
        ];
    }
}
