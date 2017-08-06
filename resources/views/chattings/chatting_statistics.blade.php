@extends('layouts.chatting_layout')
@section('content')
    <style xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        [v-cloak] {
            display: none;
        }
    </style>


    <style>

        #chartdiv2 {
            margin-bottom: 50px;
            width: 100%;
            height: 300px;
        }

   #chartdiv3 {
            margin-bottom: 50px;
            width: 100%;
            height: 300px;
        }


    </style>
    <div id="chatting" xmlns:v-bind="http://www.w3.org/1999/xhtml">

        <!-- HEADER -->
        <header class="gl-header">
            <!-- BOTTOM BAR/NAVIGATION -->
            <div class="gl-header-bottombar">
                <!-- Navigation Menu start-->
                <nav class="navbar gl-header-main-menu" role="navigation">
                    <div class="container-fluid">

                        <!-- Navbar Toggle -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <!-- Logo -->
                            <a class="navbar-brand" href="{{ url('/') }}"><img class="logo"
                                                                               src="/images/logo-header.png"
                                                                               alt="GLIMPSE"></a>
                        </div>
                        <!-- Navbar Toggle End -->

                        <!-- navbar-collapse start-->
                        <div id="nav-menu" class="navbar-collapse gl-menu-wrapper collapse" role="navigation">
                            <ul class="nav navbar-nav gl-menus">
                                <li class="active">
                                    <a href="{{ route('chattings',['name' => $ssul->name]) }}">{{ $ssul->name }}</a>
                                </li>


                                <li>
                                    <a href="{{ route('chatting_only',['name' => $ssul->name]) }}">채팅만 보기</a>
                                </li>
                                <li class="active">
                                    <a v-cloak href="{{ route('chatting_statistics',['name' => $ssul->name]) }}">통계</a>
                                </li>
                            </ul>
                        </div>
                        <!-- navbar-collapse end-->

                        <div class="gl-extra-btns-wrapper">
                            @if(!Auth::check() and Auth::user()->annony)
                                <button class="gl-login-btn" id="gl-side-menu-btn">로그인</button>
                            @endif
                            <button class="gl-add-post-btn">{{$ssul->name}} 참석자 @{{ viewers.length  }}</button>
                        </div>

                    </div>
                </nav>
                <!-- Navigation Menu end-->
            </div>
            <!-- END -->
        </header>
        <!-- HEADER END -->


        <!-- PAGE CONTETNT -->
        <section class="gl-page-content-section-chat-list" id="content-section">
            <div class="container">
                <div class="row">
                    {{--left side bar--}}
                    <div style="" class="col-md-2 col-sm-2">

                    </div>
                    {{--left side bar end--}}
                    <div class="col-md-8 col-sm-8">
                        <div class="gl-blog-details-wrapper">


                            <!-- COMMENTS -->
                            <div class="gl-post-comments-wrapper" style="margin-bottom: 10px;">

                                <h3>오늘의 {{$ssul->name}} 키워드</h3>

                                <div id="chartdiv2"></div>

                                <h3>이번주 {{$ssul->name}} 키워드</h3>

                                <div id="chartdiv3"></div>

                            </div>
                            <!-- END -->
                        </div>
                    </div>
                    <!-- END -->


                </div>
            </div>

        </section>
        <!-- PAGE CONTETNT END -->

    </div>
    <script type="text/javascript" src="http://jsgetip.appspot.com"></script>
    <script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <script>

        var chatting_app = new Vue({
            el: '#chatting',
            data: {
                typingUserName: [],
                typing: false,
                viewers: {},
                teamsPowerWidth: [],
                page: 1,
                chats: [],
                busy: false,
                isFirstLoad: true,
                chat_only: '',

                statics_max_point: 0,
                morph_statics_max_point: 0,
                statics_list: [],
                morph_statics_list: [],

                week_statics_max_point: 0,
                week_morph_statics_max_point: 0,
                week_statics_list: [],
                week_morph_statics_list: []

            },

            created: function () {
                this.statics_load();

                Echo.join('newMessage{{$ssul->id}}').listen('.testing', (e) => {


                    this.chats.push(e);

                    this.maxChatId = e.id;


                    // 맨 아래로 스크롤 이동
                    setTimeout(() => {
                        $('#content-section')[0].scrollTop = $('#content-section')[0].scrollHeight;
                    }, 10);


                }).here(viewers => {
                    console.log('abc');
                    console.log(viewers);
                    this.viewers = viewers;
                }).joining((user) => {
                    console.log(user.name);
                    this.viewers.push(user);
                }).leaving((user) => {
                    this.viewers.pop(user);
                });


                Echo.join('newMessage{{$ssul->id}}').listen('.like', (e) => {
                    console.log(e);
                    // 하트 채우기
                    if (e.available) {


                        console.log(this.myLike);

                        this.chats.forEach(function (chat) {
                            if (chat.id == e.chattingId) {
                                chat.myLike = true;
                                chat.likes.push(e.like);
                            }
                        });
                    }
                    // 하트 비우기
                    else {


                        this.chats.forEach(function (chat) {
                            if (chat.id == e.chattingId) {
                                chat.myLike = false;

                                chat.likes.forEach(function (like) {
                                    if (like.user_id == "{{Auth::user()->id}}") {
                                        chat.likes.splice(chat.likes.indexOf(like), 0);
                                    }

                                });

                                chat.likes.splice(chat.likes.indexOf(chat.id))
                            }
                        });

                    }

//                    console.log(e.popularChats);
                    $(".chat_box")[0].innerHTML = "";
                    for (var i = 0; i < e.popularChats.length; i++) {
                        $(".chat_box").append('<ul class="gry_box">' +
                            '<li class="grybox_pf_img">' +
                            '<div class="pf_img" style="background-image: url(' + e.popularChats[i].user_profile_img + ');">' + '</div>' +
                            '</li>' +
                            '<li class="grybox_sj">' + e.popularChats[i].user_name + '</li>' +
                            '<li class="grybox_good">' + e.popularChats[i].likes_count + '</li>' +
                            '<li class="grybox_txt clear">' + e.popularChats[i].content + '</li>' +
                            '</ul>');
                    }


                });

                $("#someone_typing").show();
            },

            methods: {
                statics_load: function () {


                    axios.get('{{ route('chattings.morph_statistics', ['id' => $ssul->id]) }}')
                        .then(function (response) {
                            console.log(response);

                            for (var i = 0, len = response.data.length; i < len; i++) {
                                var object = {
                                    "name": response.data[i].morph,
                                    "points": response.data[i].countMorphs,
                                    "color": "#" + ((1 << 24) * Math.random() | 0).toString(16),

                                };
                                console.log(object);
                                chatting_app.morph_statics_list.push(object);
                                console.log(chatting_app.morph_statics_list);
                            }

                            chatting_app.morph_statics_max_point = chatting_app.morph_statics_list[0].points;
                            console.log(chatting_app.morph_statics_max_point);


                            var chart2 = AmCharts.makeChart("chartdiv2",
                                {
                                    "type": "serial",
                                    "theme": "light",
                                    "dataProvider": chatting_app.morph_statics_list,
                                    "valueAxes": [{
                                        "maximum": chatting_app.morph_statics_max_point,
                                        "minimum": 0,
                                        "axisAlpha": 0,
                                        "dashLength": 4,
                                        "position": "left"
                                    }],
                                    "startDuration": 1,
                                    "graphs": [{
                                        "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
                                        "bulletOffset": 10,
                                        "bulletSize": 52,
                                        "colorField": "color",
                                        "cornerRadiusTop": 8,
                                        "customBulletField": "bullet",
                                        "fillAlphas": 0.8,
                                        "lineAlpha": 0,
                                        "type": "column",
                                        "valueField": "points"
                                    }],
                                    "marginTop": 0,
                                    "marginRight": 0,
                                    "marginLeft": 0,
                                    "marginBottom": 0,
                                    "autoMargins": false,
                                    "categoryField": "name",
                                    "categoryAxis": {
                                        "axisAlpha": 0,
                                        "gridAlpha": 0,
                                        "inside": true,
                                        "tickLength": 0
                                    },
                                    "export": {
                                        "enabled": true
                                    }
                                });

                        });


                    axios.get('{{ route('chattings.week_morph_statistics', ['id' => $ssul->id]) }}')
                        .then(function (response) {
                            console.log(response);

                            for (var i = 0, len = response.data.length; i < len; i++) {
                                var object = {
                                    "name": response.data[i].morph,
                                    "points": response.data[i].countMorphs,
                                    "color": "#" + ((1 << 24) * Math.random() | 0).toString(16),

                                };
                                console.log(object);
                                chatting_app.week_morph_statics_list.push(object);
                                console.log(chatting_app.week_morph_statics_list);
                            }

                            chatting_app.week_morph_statics_max_point = chatting_app.week_morph_statics_list[0].points;
                            console.log(chatting_app.week_morph_statics_max_point);


                            var chart2 = AmCharts.makeChart("chartdiv3",
                                {
                                    "type": "serial",
                                    "theme": "light",
                                    "dataProvider": chatting_app.week_morph_statics_list,
                                    "valueAxes": [{
                                        "maximum": chatting_app.week_morph_statics_max_point,
                                        "minimum": 0,
                                        "axisAlpha": 0,
                                        "dashLength": 4,
                                        "position": "left"
                                    }],
                                    "startDuration": 1,
                                    "graphs": [{
                                        "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
                                        "bulletOffset": 10,
                                        "bulletSize": 52,
                                        "colorField": "color",
                                        "cornerRadiusTop": 8,
                                        "customBulletField": "bullet",
                                        "fillAlphas": 0.8,
                                        "lineAlpha": 0,
                                        "type": "column",
                                        "valueField": "points"
                                    }],
                                    "marginTop": 0,
                                    "marginRight": 0,
                                    "marginLeft": 0,
                                    "marginBottom": 0,
                                    "autoMargins": false,
                                    "categoryField": "name",
                                    "categoryAxis": {
                                        "axisAlpha": 0,
                                        "gridAlpha": 0,
                                        "inside": true,
                                        "tickLength": 0
                                    },
                                    "export": {
                                        "enabled": true
                                    }
                                });

                        });

                }
            }


        })


    </script>





@endsection