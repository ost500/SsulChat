@extends('setting._layout')
@section('content')

    <section class="up-redq-frontend--section up-console-page">
        <div class="up-redq-inner-wrapper">
            <!-- LEFTSIDE NAVIGATION -->
            <nav class="up-redq-leftside-nav">
                <div class="up-redq-logo">
                    <a href="#">
                        <img src="/images/logo.png" alt="UserpLace">
                    </a>
                </div>

                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="mic-icon-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="settings.html">
                            <i class="mic-icon-settings"></i>
                            Settings
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- LEFTSIDE NAVIGATION END -->

            <!-- CONTENTS WRAPPER -->
            <div class="up-redq-contents-wrapper">

                <!-- HEADER -->
                <header class="up-redq-header-wrapper">
                    <button type="button" class="toggle-nav">
                        <span class="up-nav-bar"></span>
                        <span class="up-nav-bar"></span>
                        <span class="up-nav-bar"></span>
                    </button>

                    {{--<ul class="up-redq-header-content">--}}
                    {{--<li class="up-redq-inbox up-dropdown--btn">--}}
                    {{--<span class="up-redq-inbox-title">Inbox</span>--}}
                    {{--<span class="up-redq-icon-holder">--}}
                    {{--<i class="mic-icon-comment"></i>--}}
                    {{--<span class="up-redq-msg-count">3</span>--}}
                    {{--</span>--}}

                    {{--<ul class="up-redq--dropdown">--}}
                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<span class="up-user-img">--}}
                    {{--<img src="/images/user-img.png" alt="user">--}}
                    {{--<span class="up-user-status up-online"></span>--}}
                    {{--</span>--}}

                    {{--<span class="up-user-info">--}}
                    {{--<h3>Roman<span class="up-msg-num">(2)</span></h3>--}}
                    {{--<span class="up-msg-excerpt">Happy Birthday</span>--}}
                    {{--<span class="up-msg-time">3.30 pm</span>--}}
                    {{--</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<span class="up-user-img">--}}
                    {{--<img src="/images/user-img.png" alt="user">--}}
                    {{--<span class="up-user-status up-away"></span>--}}
                    {{--</span>--}}

                    {{--<span class="up-user-info">--}}
                    {{--<h3>Roman<span class="up-msg-num">(2)</span></h3>--}}
                    {{--<span class="up-msg-excerpt">Happy Birthday</span>--}}
                    {{--<span class="up-msg-time">3.30 pm</span>--}}
                    {{--</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<span class="up-user-img">--}}
                    {{--<img src="/images/user-img.png" alt="user">--}}
                    {{--<span class="up-user-status up-away"></span>--}}
                    {{--</span>--}}

                    {{--<span class="up-user-info">--}}
                    {{--<h3>Roman<span class="up-msg-num">(2)</span></h3>--}}
                    {{--<span class="up-msg-excerpt">Happy Birthday</span>--}}
                    {{--<span class="up-msg-time">3.30 pm</span>--}}
                    {{--</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}

                    {{--<li class="up-redq-usericon up-dropdown--btn">--}}
                    {{--<span class="up-redq-username">James Honda</span>--}}
                    {{--<span class="up-redq-userimg-wrapper">--}}
                    {{--<img src="/images/user-img.png" alt="User">--}}
                    {{--</span>--}}

                    {{--<ul class="up-redq--dropdown">--}}
                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="mic-icon-badge"></i>--}}
                    {{--Bookmark--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="mic-icon-file"></i>--}}
                    {{--Invoice--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="mic-icon-cloud"></i>--}}
                    {{--Subscribtion--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="mic-icon-settings"></i>--}}
                    {{--Settings--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="mic-icon-logout"></i>--}}
                    {{--Logout--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                </header>
                <!-- HEADER END -->

                <!-- MAIN CONTENT -->
                <div class="up-redq-main-content" id="chatting_delete">
                    <!-- ************************
                    # Listing Widget #
                    ************************* -->
                    <div class="flex-lg-12 flex-md-12 flex-sm-12 flex-xs-12">
                        <div class="up-redq-listing-widgets up-redq-widgets">
                            <!-- widget title -->
                            <div class="up-redq-widget-title">
                                <i class="mic-icon-file"></i>
                                <h3>{{$page->title}} 페이지의 메인사진</h3>
                                <span class="up-redq-widget-meta--num">{{ $page->ssuls->count() }}</span>
                            </div>
                            <!-- widget title -->

                            <img src="{{ $page->main_picture }}">
                            <form action="{{ route('pages.setting.main_picture', ['id' => $page->id]) }}" method="post"
                                  enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input name="picture" type="file">
                                <button type="submit">제출</button>
                            </form>
                            <!-- widget body end -->
                        </div>

                        <div class="up-redq-listing-widgets up-redq-widgets">
                            <!-- widget title -->
                            <div class="up-redq-widget-title">
                                <i class="mic-icon-file"></i>
                                <h3>{{$page->title}} 페이지의 배경사진</h3>
                                <span class="up-redq-widget-meta--num">{{ $page->ssuls->count() }}</span>
                            </div>
                            <!-- widget title -->

                            <img src="{{ $page->background_picture }}">
                            <form action="{{ route('pages.setting.background_picture', ['id' => $page->id]) }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input name="picture" type="file">
                                <button type="submit">제출</button>
                            </form>
                            <!-- widget body end -->
                        </div>

                        <!-- ************************
                        # Listing Widget #
                        ************************* -->
                        <div class="flex-lg-12 flex-md-12 flex-sm-12 flex-xs-12">
                            <div class="up-redq-listing-widgets up-redq-widgets">
                                <!-- widget title -->
                                <div class="up-redq-widget-title">
                                    <i class="mic-icon-file"></i>
                                    <h3>{{$page->title}} 페이지의 채팅방 리스트</h3>
                                    <span class="up-redq-widget-meta--num">{{ $page->ssuls->count() }}</span>
                                </div>
                                <!-- widget title -->

                                <!-- widget body -->
                                <div class="up-redq-widget-body up-redq-listings-list">

                                    <div class="up-redq-list-item">
                                        <a href="{{ route('pages.setting.chatting_create',['id' => $page->id]) }}"><h3
                                                    class="up-redq-service-name">+ 채팅방 추가하기</h3></a>


                                        <div class="up-redq-fav-btn">
                                            <input type="checkbox" name="favourite" id="favourite-1">
                                            <label for="favourite-1">
                                                <i class="fa fa-plus"></i>
                                            </label>
                                        </div>
                                    </div>

                                @foreach($page->ssuls as $ssul)
                                    <!-- list -->
                                        <div class="up-redq-list-item">
                                            <h3 class="up-redq-service-name">{{ $ssul->name }}</h3>

                                            <span class="up-redq-post-time">{{ $ssul->created_at }}</span>
                                            <div class="up-redq-fav-btn">
                                                <input type="checkbox" name="favourite" id="favourite-1">
                                                <label for="favourite-1" v-on:click="deleteSsul({{ $ssul->id }})">
                                                    <i class="fa fa-minus"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- list -->
                                    @endforeach
                                </div>
                                <!-- widget body end -->
                            </div>
                        </div>
                        <!-- # Listing Widget End # -->


                        {{--<!-- ************************--}}
                        {{--# Notifier Widget #--}}
                        {{--************************* -->--}}
                        {{--<div class="flex-md-12 flex-sm-12 flex-xs-12">--}}
                        {{--<div class="up-redq-notification-widgets up-redq-widgets">--}}
                        {{--<p>Your subscription is about to expired. Please update your <a href="#">subscription</a> here--}}
                        {{--</p>--}}
                        {{--<button class="up-redq-notification-close-btn">--}}
                        {{--<i class="ion-ios-close-empty"></i>--}}
                        {{--</button>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- # Notifier Widget End # -->--}}


                    </div>
                    <!-- MAIN CONTENT END -->
                </div>
                <!-- CONTENTS WRAPPER END -->
            </div>
    </section>

    <script>

        var main = new Vue({
            el: '#chatting_delete',
            data: {},
            created: function () {

            },
            methods: {
                deleteSsul: function (ssul_id) {
                    if (confirm('식제하시겠습니까?')) {
                        axios.delete('{{ route('pages.setting.chatting.delete',['id' => $page->id]) }}',
                            {params: {ssul_id: ssul_id}}).then(function () {
                            location.reload();
                        });
                    }
                }
            }
        })
    </script>
@endsection
