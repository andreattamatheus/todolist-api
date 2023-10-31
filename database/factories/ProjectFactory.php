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
            'id' => $this->faker->Uuid(),
            'name' => $this->faker->company,
            'color' => $this->faker->hexColor,
            'favorite' => $this->faker->boolean(50), // 50% chance of being true or false
            'user_id' => '375defa7-54d9-49c3-9c71-18104d774963',
        ];
    }
}
