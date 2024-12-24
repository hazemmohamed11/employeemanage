<?php
namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        return Employee::with('department')->get();
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function find($id)
    {
        return Employee::findOrFail($id);
    }

    public function update($id, array $data)
    {
        return Employee::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Employee::destroy($id);
    }
}
