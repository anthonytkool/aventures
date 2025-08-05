<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <!-- ใส่เมนู admin ที่ต้องการ -->
        <a href="{{ route('admin.tours.index') }}">Tours</a> |
        <a href="/">Visit Site</a>
    </nav>
    <div class="container">
        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>