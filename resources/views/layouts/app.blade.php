<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    {!! SEO::generate() !!}
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

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8665007420370986",
            enable_page_level_ads: true
        });
    </script>
</head>

<body class="gl-business-template gl-home-template @if(isset($loginView) || $errors->has('email') || $errors->has('password')) gl-show-menu @endif">

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
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <input type="text" name="email" id="gl-user-input" placeholder="이메일">
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                        <input type="password" name="password" id="gl-user-password" placeholder="패스워드">
                        @if ($errors->has('password'))

                            {{ $errors->first('password') }}

                        @endif
                        <button type="submit">로그인</button>
                    </form>
                </div>

                <div class="gl-social-login-opt">
                    <a href="{{ route('facebookLogin') }}" class="gl-social-login-btn gl-facebook-login">페이스북으로 로그인</a>

                </div>

                <div class="gl-other-options">
                    <a href="{{ route('password.request')  }}" class="gl-forgot-pass">비밀번호를 잊으셨나요?</a>
                    <a href="{{ route('register') }}" class="gl-signup">가입하기</a>
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
                    <ul class="nav navbar-nav
                     gl-menus">
                        <li class="{{ (Request::is('/')) ? "active": "" }}">
                            <a href="{{ url('/') }}">홈</a>
                        </li>
                        <li class="{{ (Request::is('pages')) || (Request::is('pages/*')) ? "active": "" }}">
                            <a href="{{ route('pageList') }}">페이지</a>

                        </li>
                        <li class="{{ (Request::is('chattings')) ? "active": "" }}">
                            <a href="{{ route('chattingList') }}">채팅</a>
                        </li>

                        @if(Auth::check())
                            <li style="padding:0px" class="{{ (Request::is('mypage')) ? "active": "" }}">
                                <a href="{{ route('mypage') }}">
                                    <img src="{{ Auth::user()->profile_img }}" alt="User"
                                         class="gl-lazy">
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- navbar-collapse end-->

                <div class="gl-extra-btns-wrapper">

                    @if(!Auth::check())
                        <button class="gl-login-btn" id="gl-side-menu-btn">로그인</button>
                    @else


                    @endif

                    <button onclick="location.href='{{ route('create_page') }}'" class="gl-add-post-btn">+ 채팅 페이지 만들기</button>
                </div>

            </div>
        </nav>
        <!-- Navigation Menu end-->
    </div>
    <!-- END -->
</header>
<!-- HEADER END -->

@if(Auth::check())
    <section class="gl-fake-div" style="height: 70px;"></section>
@endif

<script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>


@yield('content')


<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-99980515-1', 'auto');
    ga('send', 'pageview');

</script>


<!-- FOOTER -->
<footer>

    <!-- FOOTER BOTTOM -->
    <div class="gl-footer-bottom-wrapper">
        <div class="container">
            <div class="row">
                <!-- COPYRIGHT INFO -->
                <div class="gl-copyright-info-wrapper">
                    <p>Copyright &copy; 2016 WIKICHAT. All rights reserved</p>
                </div>
                <!-- COPYRIGHT INFO -->

                <div class="gl-social-info-wrapper">
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-twitter"></i>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-behance"></i>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-dribbble"></i>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="#">--}}
                        {{--<i class="fa fa-vimeo"></i>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->
</footer>
<!-- FOOTER END -->

<script src="/js/jquery.min.js"></script>
<!-- Scripts -->



<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBF0FPDHlurGkDKua7PfZjpD2fr2rQsRw0&libraries=places"></script>
<script src="/js/google-autocomplete.js"></script>

<script src="/js/plugins.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/main.js"></script>
</body>
</html>