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
            'description' => $this->faker->sentence,
            'project_id' => '2cc5e3a3-31d0-3b1a-ac7f-62f03e7c50a5',
            'user_id' => '375defa7-54d9-49c3-9c71-18104d774963',
        ];
    }
}
