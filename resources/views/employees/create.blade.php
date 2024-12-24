@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
    <h2>Add Employee</h2>
    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" required>

        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" required>

        <label for="salary">Salary</label>
        <input type="number" name="salary" id="salary" required>

        <label for="manager_name">Manager Name</label>
        <input type="text" name="manager_name" id="manager_name" required>

        <label for="image">Profile Picture</label>
        <input type="file" name="image" id="image">

        <label for="department_id">Department</label>
        <select name="department_id" id="department_id" required>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>

        <button type="submit">Save</button>
    </form>
@endsection
