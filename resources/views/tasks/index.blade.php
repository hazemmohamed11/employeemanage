@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks for {{ $employee->first_name }} {{ $employee->last_name }}</h1>
        <a href="{{ route('tasks.create', ['employee' => $employee->id]) }}" class="btn btn-primary">Create Task</a>

        @if($tasks->isEmpty())
            <p>No tasks assigned yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
