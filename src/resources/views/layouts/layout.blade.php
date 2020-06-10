<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>9292web</title>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')
</body>
</html>
