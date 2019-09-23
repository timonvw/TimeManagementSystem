<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', "Time Management System")</title>

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
       @yield('content')
    </body>
</html>
