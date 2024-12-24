<?php
namespace App\Repositories\Interfaces;

interface DepartmentRepositoryInterface
{
    public function getAllDepartments();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getAllDepartmentsWithDetails();
}