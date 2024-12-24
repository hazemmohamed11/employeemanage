<?php
namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function getAllTasksForEmployee($employeeId);
    public function create(array $data);
    public function updateStatus($taskId, $status);
}