<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $privileges = [0, 1, 10];
        // $cities = City::all()->pluck('id')->values()->toArray();
        // $city = $cities[array_rand($cities)];
        // $province = Province::find(City::find($city)->province_id)->id;
        return [
            'name' => $this->faker->name(),
            'family' => $this->faker->lastName(),
            // 'email_verified_at' => null,
            'password' => bcrypt('123456'), // password
            'national_code' => strval(rand(1000000000, 9999999999)),
            'mobile' => '091'.rand(10000000,99999999),
            'privilege' => $privileges[array_rand($privileges)],
            'birth_day' => $this->faker->date('Y-m-d H:i:s'),
            // 'city_id' => $city,
            // 'province_id' => $province,
            // 'age' => rand(15, 50),
            'gender' => rand(0,1),
            'about_me' => $this->faker->text(),
            'status' => rand(0,3),

        ];
    }


    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
