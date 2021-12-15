<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('dist/frontend/css/app.css') }}" rel="stylesheet">
    <title>{{$page_title ?? 'Installer'}}</title>
</head>
<body class="bg-gray-100">
@yield('content')
</body>
</html>
