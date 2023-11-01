<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'color' => $this->faker->hexColor,
            'favorite' => $this->faker->boolean(50), // 50% chance of being true or false
            'user_id' => User::all()->random()->id,
        ];
    }
}
