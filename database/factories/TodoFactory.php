<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo;
use App\Models\User;
use App\Models\Project;
use Ramsey\Uuid\Uuid;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'project_id' => Project::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
