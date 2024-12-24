<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;
    protected $employeeRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->taskRepository = $taskRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function create($employeeId)
    {
        $employee = $this->employeeRepository->find($employeeId);
        return view('tasks.create', compact('employee'));
    }

    public function store(Request $request, $employeeId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $this->taskRepository->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'pending',
            'employee_id' => $employeeId,
            'manager_id' => auth()->id(),
        ]);

        return redirect()->route('employees.index', ['employee' => $employeeId])->with('success', 'Task created successfully.');
    }

    public function index($employeeId)
    {
        // Retrieve the employee by ID
        $employee = $this->employeeRepository->find($employeeId);
    
        if (!$employee) {
            abort(404, 'Employee not found.');
        }
    
        // Retrieve tasks for the specific employee
        $tasks = $this->taskRepository->getAllTasksForEmployee($employeeId);
    
        // Pass both tasks and employee to the view
        return view('tasks.index', compact('tasks', 'employee'));
    }
        public function updateStatus($taskId, $status)
    {
        $this->taskRepository->updateStatus($taskId, $status);
        return back()->with('success', 'Task status updated successfully.');
    }
}
