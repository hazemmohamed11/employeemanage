@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    <h2>Departments</h2>
    <a href="{{ route('departments.create') }}">Add New Department</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Employee Count</th>
                <th>Total Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->employees_count }}</td>
                    <td>${{ number_format($department->employees_sum_salary, 2) }}</td> <!-- Total salaries -->
                    <td>
                        <a href="{{ route('departments.edit', $department->id) }}">Edit</a>
                        <form method="POST" action="{{ route('departments.destroy', $department->id) }}" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
