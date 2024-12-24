<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'salary' => $this->faker->randomFloat(2, 3000, 10000),
            'manager_name' => 'ha', // Set a default value or handle relationships
            'image' => 'default.jpg', // Placeholder for an image field
            'department_id' => '1', // Placeholder for an image field

        ];
    }
}
