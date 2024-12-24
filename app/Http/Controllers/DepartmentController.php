<?php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $departments = $this->departmentRepository->getAllDepartmentsWithDetails();
        return view('departments.index', compact('departments'));
        }
    // Add other methods for create, edit, update, and delete
    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $this->departmentRepository->create($validated);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        $department = $this->departmentRepository->find($id);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $this->departmentRepository->update($id, $validated);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $this->departmentRepository->delete($id);
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
