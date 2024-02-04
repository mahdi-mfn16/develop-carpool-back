<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->values()->toArray();
        $cities = City::all()->pluck('id')->values()->toArray();
        $types = ['rider', 'passenger'];
        return [
            'user_id' => $users[array_rand($users)],
            'origin_city_id' => $cities[array_rand($cities)],
            'destination_city_id' => $cities[array_rand($cities)],
            'capacity' => rand(2,4),
            'booked' => 0,
            'origin_address' => $this->faker->address(),
            'destination_address' => $this->faker->address(),
            'origin_lng' => $this->faker->longitude(),
            'origin_lat' => $this->faker->latitude(),
            'destination_lng' => $this->faker->longitude(),
            'destination_lat' => $this->faker->latitude(),
            'distance' => rand(50, 100),
            'date' => $this->faker->date('Y-m-d').' 00:00:00',
            'start_time' => $this->faker->date('h:i'),
            'end_time' => $this->faker->date('h:i'),
            'price' => rand(10,20),
            'fee' => rand(3,6),
            'user_vehicle_id' => null,
            'status' => rand(0,1),
            'description' => $this->faker->text(),
            'type' => $types[rand(0,1)],
        ];
    }


}