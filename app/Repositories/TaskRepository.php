<?php
namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasksForEmployee($employeeId)
    {
        return Task::where('employee_id', $employeeId)->get();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function updateStatus($taskId, $status)
    {
        $task = Task::findOrFail($taskId);
        $task->status = $status;
        $task->save();
        return $task;
    }
}
