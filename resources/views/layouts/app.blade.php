<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AventureTrip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar-brand img {
            height: 100px; /* ✅ ลดลง 10% จาก 125px */
            width: auto;
        }
    </style>
</head>
<body>

    {{-- ✅ Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('storage/assets/logo.png') }}" alt="AventureTrip">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tours.index') }}">Tours</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ✅ Main Section --}}
    <div class="container my-5" style="margin-top: 0 !important;">
        @yield('content')
    </div>

    {{-- ✅ Footer --}}
    <footer class="bg-dark text-white py-3 text-center mt-5">
        <small>&copy; {{ date('Y') }} AventureTrip. All rights reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
