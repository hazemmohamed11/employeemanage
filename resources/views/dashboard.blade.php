


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Welcome to Your Dashboard</h1>
            <p>Welcome {{ auth()->user()->name }}!</p>

            @if(auth()->user()->hasRole('employee') || auth()->user()->hasRole('manager'))
                <div class="alert alert-info">
                    You are being redirected to your tasks page.
                </div>
                <p>Redirecting...</p>
            @else
                <div class="alert alert-warning">
                    You do not have access to task management. Please complete your profile.
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            @endif
        </div>
    </div>
</div>
@endsection
