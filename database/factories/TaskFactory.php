<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'completed']),
            'employee_id' => Employee::factory(), // This will assign the task to a new employee
            'created_by' => 1, // Replace with a valid admin/manager ID
        ];
    }
}
