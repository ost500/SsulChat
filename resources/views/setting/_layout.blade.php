<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PAGE TITLE -->
    <title>User place Frontend</title>

    <!-- FAVICON ICONS -->
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="/css/frontend-submission.style.css">
</head>

<body>

<script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
@yield('content')
<script src="/js/jquery.min.js"></script>
<script src="/js/plugins.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
