<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="{{ asset("assets/css/vendor.min.css") }}" rel="stylesheet" />
    <link href="{{ asset("assets/css/app.min.css") }}" rel="stylesheet" />
    @yield('css')
</head>

<body class='pace-top'>

    <div id="app" class="app app-full-height app-without-header">
        @yield('content')
    </div>

    <script src="{{ asset("assets/js/vendor.min.js") }}" type="540fdc04f56ad095af2eb37b-text/javascript"></script>
    <script src="{{ asset("assets/js/app.min.js") }}" type="540fdc04f56ad095af2eb37b-text/javascript"></script>
    @yield('js')
</body>

</html>
