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
            'id' => $this->faker->Uuid(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'project_id' => Project::all()->random()->id,
            'user_id' => User::factory(),
        ];
    }
}
