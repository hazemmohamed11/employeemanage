<!-- resources/views/employees/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>
    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $employee->first_name) }}">
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $employee->last_name) }}">
        </div>
        <div>
            <label for="salary">Salary:</label>
            <input type="number" name="salary" id="salary" value="{{ old('salary', $employee->salary) }}">
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <label for="department_id">Department:</label>
            <select name="department_id" id="department_id">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit">Update Employee</button>
        </div>
    </form>
</body>
</html>
