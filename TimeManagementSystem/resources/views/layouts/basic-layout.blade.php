<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', "Time Management System")</title>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('js/base.js')}}"></script>
    <!-- Styles -->
    <style>

    </style>

</head>

<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
            <p>Time Management</p>
            {{-- <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28"> --}}
            </a>

            <a role="button" class="navbar-burger burger" onclick="document.querySelector('.navbar-menu').classList.toggle('is-active');" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
            <a class="navbar-item">
                Home
            </a>

            <a class="navbar-item">
                Projects
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                More
                </a>

                <div class="navbar-dropdown">
                <a class="navbar-item">
                    About
                </a>
                <a class="navbar-item">
                    Jobs
                </a>
                <a class="navbar-item">
                    Contact
                </a>
                <hr class="navbar-divider">
                <a class="navbar-item">
                    Report an issue
                </a>
                </div>
            </div>
            </div>

            <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                <a class="button is-primary" href="/register">
                    <strong>Sign up</strong>
                </a>
                <a class="button is-light" href="/login">
                    Log in
                </a>
                </div>
            </div>
            </div>
        </div>
</nav>

<section class="section">
<div class="container">
    @yield('content')
</div>
</section>


<footer class="footer">
    <div class="content has-text-centered">
        <p>
        <strong>Time Mangement</strong> by <a href="/">Timon van Waardhuizens</a>. The source code is licensed
        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
        is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
        </p>
    </div>
</footer>
</body>

</html>
