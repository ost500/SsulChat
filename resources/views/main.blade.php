<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- PAGE TITLE -->
    <title>Glimpse - Business</title>

    <!-- FAVICON ICONS -->
    <link rel="shortcut icon" href="/images/favicon.ico">

    <link rel="stylesheet" href="/css/business.style.css">
</head>

<body class="gl-business-template gl-home-template">

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
                    <a class="navbar-brand" href="index.html"><img class="logo" src="/images/logo-header.png" alt="GLIMPSE"></a>
                </div>
                <!-- Navbar Toggle End -->

                <!-- navbar-collapse start-->
                <div id="nav-menu" class="navbar-collapse gl-menu-wrapper collapse" role="navigation">
                    <ul class="nav navbar-nav gl-menus">
                        <li class="active">
                            <a href="index.html">Home</a>
                            <ul class="gl-sub-menu">
                                <li>
                                    <a href="/jobs/index.html">Home - Job</a>
                                </li>
                                <li>
                                    <a href="/real-estate/index.html">Home - Real Estate</a>
                                </li>
                                <li>
                                    <a href="/restaurant/index.html">Home - Restaurant</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="listing-style-1.html">Listing</a>
                            <ul class="gl-sub-menu">
                                <li>
                                    <a href="listing-style-2.html">Listing Style - Map Right</a>
                                </li>
                                <li>
                                    <a href="listing-style-3.html">Listing Style - Map Top</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="company.html">company</a>
                        </li>
                        <li>
                            <a href="about-us.html">About</a>
                        </li>
                        <li>
                            <a href="/elements/elements.html">Elements</a>
                            <ul class="gl-sub-menu">
                                <li>
                                    <a href="/frontend-subbmission/index.html">Frontend Submission Page</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="blog-grid.html">Blog</a>
                            <ul class="gl-sub-menu">
                                <li>
                                    <a href="blog-default.html">Blog Default</a>
                                </li>
                                <li>
                                    <a href="blog-details.html">Blog Details</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="contact-us.html">Contact</a>
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

<!-- HERO IMAGE -->
<section class="gl-hero-img-wrapper">
    <div class="container">
        <div class="row">
            <div class="gl-elements-content-wrapper">
                <div id="typed-strings">
                    <p>모두의 <span class="gl-color-text">WIKICHAT</span> </p>
                    <p>내가 만드는 <span class="gl-color-text">빅데이터</span> </p>
                    {{--<p>Find The <span class="gl-color-text">Best Places</span> In Your City</p>--}}
                </div>
                <h2 id="gl-slogan" class="gl-hero-text-heading"></h2>
                <p class="gl-hero-text-paragraph">아무말 대잔치</p>

                <!-- DIRECTORY FORM -->
                <div class="gl-directory-searchbar gl-bz-directory-searchbar">
                    <form action="#" id="gl-bz-directory-form">
                        <fieldset>
                            <input type="text" name="gl-business-keyword" id="gl-business-keyword" class="gl-directory-input" placeholder="키워드">



                        </fieldset>

                        <button type="submit" class="gl-icon-btn"><i class="fa fa-search"></i> 검색</button>
                    </form>
                </div>
                <!-- END -->

            </div>
        </div>
    </div>
</section>
<!-- HERO IMAGE END -->



<!-- FEATURED LISTINGS -->
<section class="gl-feat-listing-section gl-section-wrapper">
    <div class="container">
        <div class="row">
            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>채팅 그룹</h1>
                <p>Checkout and enjoy the biggest unlimited possiblities</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                @foreach($channels as $num => $channel)

                    <!-- FEATURED ITEMS -->
                    <div class="gl-featured-items col-md-2 col-sm-2 col-xs-12 appear fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="gl-feat-items-img-wrapper">

                            <picture>
                                <source media="(min-width: 768px)" srcset="{{ $channel->picture }}">
                                <img alt="Featured Listing" srcset="{{ $channel->picture }}">
                            </picture>
                        </div>

                        <div class="gl-feat-item-details">
                            <span class="gl-item-rating">
                              <i class="ion-android-star-outline"></i>
                                @if(isset($channel->chat_count))
                                    {{ $channel->chat_count }}
                                @endif
                            </span>
                            <h3>
                                <a href="{{ route('chattings',['id'=>$channel->id]) }}">{{ $channel->name }}</a>
                            </h3>

                        </div>
                    </div>
                    <!-- END -->
            @endforeach


            </div>
            <!-- END -->

            <!-- MORE BTN -->
            <div class="gl-more-btn-wrapper">
                <a href="#" class="gl-more-btn gl-btn">More</a>
            </div>
            <!-- END -->
        </div>
    </div>
</section>
<!-- FEATURED LISTINGS END -->



<!-- FOOTER -->
<footer>

    <!-- FOOTER BOTTOM -->
    <div class="gl-footer-bottom-wrapper">
        <div class="container">
            <div class="row">
                <!-- COPYRIGHT INFO -->
                <div class="gl-copyright-info-wrapper">
                    <p>Copyright &copy; 2016 Glimpse. All rights reserved</p>
                </div>
                <!-- COPYRIGHT INFO -->

                <div class="gl-social-info-wrapper">
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-behance"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-dribbble"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-vimeo"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->
</footer>
<!-- FOOTER END -->

<script src="/js/jquery.min.js"></script>


<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBF0FPDHlurGkDKua7PfZjpD2fr2rQsRw0&libraries=places"></script>
<script src="/js/google-autocomplete.js"></script>

<script src="/js/plugins.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
