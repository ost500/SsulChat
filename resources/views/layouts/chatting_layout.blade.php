<!DOCTYPE html>
<html style="height:100%" lang="{{ config('app.locale') }}">

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