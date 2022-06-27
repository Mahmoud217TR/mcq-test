<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(),
            'degree' => $this->faker->numberBetween(1,4),
            'choice1' => $this->faker->sentence(),
            'choice2' => $this->faker->sentence(),
            'choice3' => $this->faker->sentence(),
            'choice4' => $this->faker->sentence(),
            'answer' => $this->faker->numberBetween(1,4),
        ];
    }
}
