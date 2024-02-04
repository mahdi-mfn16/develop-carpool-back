<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => 1,
            'name' => $this->faker->image(),
            'path' => $this->faker->imageUrl(),
            'type' => 'profile',
            'filable_id' => 1,
            'filable_type' => User::class, 
            'status' => rand(0,1),
            
        ];
    }

}
