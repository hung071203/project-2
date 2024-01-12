<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'e_Name' => $this->faker->name,
            'e_Email' => $this->faker->email,
            'e_Phone' => $this->faker->phoneNumber,
            'e_Pass' => bcrypt('123456')
        ];
    }
}
