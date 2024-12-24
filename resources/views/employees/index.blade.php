@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <h2>Employees</h2>

    <form method="GET" action="{{ route('employees.index') }}">
        <input type="text" name="search" placeholder="Search by name">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('employees.create') }}">Add New Employee</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Manager</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>{{ $employee->manager_name }}</td>
                    <td>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <a href="{{ route('tasks.index', ['employee' => $employee->id]) }}">View Tasks</a>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
