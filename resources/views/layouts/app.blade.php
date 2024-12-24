<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add this inside the <head> tag for Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Add this before the closing </body> tag for Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script></head>
    <body>
        
    <div class="container">
        <header>
            <h1>Employee Application</h1>
            <nav>
            <ul>
    <!-- Check if the logged-in user is a manager -->
    @if(Auth::check() && Auth::user()->role == 'manager')
        <li><a href="{{ route('employees.index') }}">Employees</a></li>
        <li><a href="{{ route('departments.index') }}">Departments</a></li>
    @endif

      <!-- Check if the logged-in user is an employee -->
      @if(Auth::check() && Auth::user()->role == 'employee')
        <li><a href="{{ route('tasks.index', ['employee' => Auth::user()->id]) }}">My Tasks</a></li>
    @endif
</ul>

<form method="POST" action="{{ route('logout') }}" style="position: fixed; top: 10px; right: 10px;">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>