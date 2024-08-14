<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPK Motor')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                SPK AHP
            </a>
            <ul class="navbar-nav ml-auto">
                @if(auth()->check())
                <li><a href="{{ route('criteria.index') }}" class="btn btn-primary">Criteria</a></li>
                @endif

                <li><a href="{{ route('alternatives.index') }}" class="btn btn-primary">Alternatives</a></li>

                @if(auth()->check())
                <li><a href="{{ route('criteria_comparisons.index') }}" class="btn btn-primary">Criteria Comparison</a></li>
                @endif
                <li><a href="{{ route('alternative-comparisons.index') }}" class="btn btn-primary">Alternative Comparison</a></li>
                <li><a href="{{ route('results.index') }}" class="btn btn-primary">Ranking Results</a></li>

                @if(auth()->check())
                <li><a href="{{ route('proses-logout') }}" class="btn btn-secondary">Logout</a></li>
                @endif

                @if(!auth()->check())
                <li><a href="{{ route('login') }}" class="btn btn-secondary">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center mt-4">
        <p>&copy;SPK AHP Skripsi AndrewKurniawan.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
