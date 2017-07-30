<!DOCTYPE html>
<html style="height:100%" lang="{{ config('app.locale') }}">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- PAGE TITLE -->
    <title>{{ config('app.name', 'WIKICHAT') }}</title>

    <!-- FAVICON ICONS -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.ico">

    <link rel="stylesheet" href="/css/business.style.css">
</head>

<body style="height:100%; position:relative" class="gl-business-template gl-home-template">

<div id="gl-circle-loader-wrapper">
    <div id="gl-circle-loader-center">
        <div class="gl-circle-load">
            <img src="/images/ploading.gif" alt="Page Loader">
        </div>
    </div>
</div>

<!--================================
            SIDE MENU
=================================-->
<!-- PAGE OVERLAY WHEN MENU ACTIVE -->
<div class="gl-side-menu-overlay"></div>
<!-- PAGE OVERLAY WHEN MENU ACTIVE END -->

<div class="gl-side-menu-wrap">
    <div class="gl-side-menu">
        <div class="gl-side-menu-widget-wrap">
            <div class="gl-login-form-wrapper">
                <h3>로그인</h3>
                <p>정보의 바다로 로그인하세요</p>

                <div class="gl-login-form">
                    <form action="#">
                        <input type="text" name="gl-user-name" id="gl-user-input" placeholder="이메일">
                        <input type="password" name="gl-user-password" id="gl-user-password" placeholder="패스워드">
                        <button type="submit">로그인</button>
                    </form>
                </div>

                <div class="gl-social-login-opt">
                    <a href="#" class="gl-social-login-btn gl-facebook-login">페이스북으로 로그인</a>

                </div>

                <div class="gl-other-options">
                    <a href="#" class="gl-forgot-pass">비밀번호를 잊으셨나요?</a>
                    <a href="#" class="gl-signup">가입하기</a>
                </div>
            </div>
        </div>
    </div>

    <button class="gl-side-menu-close-button" id="gl-side-menu-close-button">Close Menu</button>
</div>
<!-- SIDE MENU END -->


<!-- HEADER -->
<header class="gl-header">
    <!-- BOTTOM BAR/NAVIGATION -->
    <div class="gl-header-bottombar">
        <!-- Navigation Menu start-->
        <nav class="navbar gl-header-main-menu" role="navigation">
            <div class="container-fluid">

                <!-- Navbar Toggle -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Logo -->
                    <a class="navbar-brand" href="{{ url('/') }}"><img class="logo" src="/images/logo-header.png"
                                                                   alt="GLIMPSE"></a>
                </div>
                <!-- Navbar Toggle End -->

                <!-- navbar-collapse start-->
                <div id="nav-menu" class="navbar-collapse gl-menu-wrapper collapse" role="navigation">
                    <ul class="nav navbar-nav gl-menus">
                        <li class="active">
                            <a href="{{ url('/') }}">홈</a>
                        </li>
                        <li>
                            <a href="{{ route('pageList') }}">페이지</a>

                        </li>
                        <li>
                            <a href="{{ route('chattingList') }}">채팅</a>
                        </li>
                    </ul>
                </div>
                <!-- navbar-collapse end-->

                <div class="gl-extra-btns-wrapper">
                    <button class="gl-login-btn" id="gl-side-menu-btn">로그인</button>
                    <button class="gl-add-post-btn">+ 채팅 페이지 만들기</button>
                </div>

            </div>
        </nav>
        <!-- Navigation Menu end-->
    </div>
    <!-- END -->
</header>
<!-- HEADER END -->


@yield('content')



<!-- FOOTER END -->

<script src="/js/jquery.min.js"></script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>


<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBF0FPDHlurGkDKua7PfZjpD2fr2rQsRw0&libraries=places"></script>
<script src="/js/google-autocomplete.js"></script>

<script src="/js/plugins.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/main.js"></script>
</body>
</html>