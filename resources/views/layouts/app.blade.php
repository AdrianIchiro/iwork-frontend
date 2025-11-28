<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My App' }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom Global Styles --}}
    <style>
        body {
            background: #f5f5f5;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
    </style>

    {{-- Page-specific CSS --}}
    @stack('styles')
</head>

<body>

    <div class="main-container">
        {{-- Main Content --}}
        <main class="flex-fill">
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Page-specific Scripts --}}
    @stack('scripts')

</body>

</html>
