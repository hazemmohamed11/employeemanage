<?php
namespace App\Repositories;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function getAllDepartments()
    {
        return Department::with('employees')->get();
    }

    public function create(array $data)
    {
        return Department::create($data);
    }

    public function update($id, array $data)
    {
        return Department::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Department::destroy($id);
    }

    public function getAllDepartmentsWithDetails()
    {
        return Department::withCount('employees')
            ->withSum('employees', 'salary') // Add salary sum
            ->get();
    }
}
