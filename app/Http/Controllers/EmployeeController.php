<?php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepository;
    protected $departmentRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $employees = $this->employeeRepository->getAllEmployees();

        if ($search) {
            $employees = $employees->filter(function ($employee) use ($search) {
                return str_contains(strtolower($employee->first_name), strtolower($search)) ||
                       str_contains(strtolower($employee->last_name), strtolower($search));
            });
        }

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = $this->departmentRepository->getAllDepartments();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'manager_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('employees', 'public');
        }

        $this->employeeRepository->create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);
        $departments = $this->departmentRepository->getAllDepartments();

        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'manager_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('employees', 'public');
        }

        $this->employeeRepository->update($id, $validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $this->employeeRepository->delete($id);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }
}
