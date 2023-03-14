<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->streetAddress(),
            'town_city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'post_code' => $this->faker->postcode(),
            'phone' => $this->faker->phoneNumber(),
            'owner_id' => User::all()->random(1)->first()->pluck('id')[0]
        ];
    }
}
