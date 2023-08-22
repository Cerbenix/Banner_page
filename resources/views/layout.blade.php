<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Management</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <nav class="bg-white p-4 mb-4 shadow">
        <a class="text-2xl font-bold" href="#">Banner Management</a>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @yield('content')
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
