@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Task to {{ $employee->first_name }} {{ $employee->last_name }}</h2>

    <form action="{{ route('tasks.store', ['employee' => $employee->id]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Assign Task</button>
    </form>
</div>
@endsection
