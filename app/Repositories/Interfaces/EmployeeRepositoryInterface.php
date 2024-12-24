<?php
namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getAllEmployees();
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
}
