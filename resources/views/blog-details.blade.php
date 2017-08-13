@extends('layouts.chatting_layout')
@section('content')
    <style>
        [v-cloak] {
            display: none;
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


                                <li v-bind:class="{'active' : chat_only}">
                                    <a href="{{ route('chatting_only',['name' => $ssul->name]) }}">채팅만 보기</a>
                                </li>
                                <li>
                                    <a v-cloak
                                       href="{{ route('chatting_statistics', ['name' => $ssul->name]) }}">통계</a>
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

                                <!-- Reviews -->
                                <!-- END -->
                                <div class="gl-comments">
                                    <infinite-loading :on-infinite="loadMore" ref="infiniteLoading"
                                                      direction="top"></infinite-loading>
                                    <ul id="chatrow">

                                        <li v-for="chat in chats" class="normal_chat" v-bind:id="'chatrow'+chat.id">
                                            <!-- USER IMG -->
                                            <div class="chat-user-img">
                                                <img v-bind:src="chat.user.profile_img" alt="User" class="gl-lazy">
                                            </div>
                                            <!-- END -->

                                            <!-- TEXT -->
                                            <div class="gl-comment-text-chat">

                                                <div class="gl-username-date">
                                                    <h3>@{{chat.user.name}}</h3>
                                                    <span class="gl-comments-date">@{{chat.created_at}}   @{{chat.ipadress}}</span>

                                                </div>
                                                <p v-if="chat.picture != '' && chat.picture != null">
                                                    <a v-bind:href="chat.url">
                                                        <img style="width:200px;" v-bind:src="chat.picture">
                                                    </a>
                                                </p>


                                                <p v-cloak class="chat_text">
                                                    @{{chat.content}}


                                                    <button style="border:0;background:transparent;margin-left:1%"
                                                            v-on:click="like(chat.id)">


                                                        <div v-if="chat.myLike">
                                                            <img src="/images/like.png" style="width: 55%;">
                                                            <h5 v-cloak
                                                                style="float:right;font-weight: bold;color:#D75A4A">@{{chat.likes.length}}</h5>
                                                        </div>

                                                        <div v-else>
                                                            <img src="/images/like_blank.png" style="width: 55%;">
                                                            <h5 v-cloak
                                                                style="float:right">@{{ chat.likes.length }}</h5>
                                                        </div>

                                                    </button>
                                                </p>
                                            </div>
                                            <!-- END -->
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <!-- END -->
                        </div>
                    </div>
                    <!-- END -->


                </div>
            </div>

        </section>
        <!-- PAGE CONTETNT END -->
        <!-- PAGE CONTETNT -->
        <section class="gl-page-content-section-chat">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2"></div>
                    <div class="col-md-8 col-sm-8">
                        <div class="gl-blog-details-wrapper">


                            <!-- COMMENTS -->
                            <div class="gl-post-comments-wrapper" style="margin-bottom: 10px;">

                                <!-- Reviews -->
                                <div class="gl-comments">
                                    <!-- USER IMG -->
                                    <div class="chat-user-img">
                                        <img src="{{Auth::user()->profile_img}}" alt="User" class="gl-lazy">
                                    </div>
                                    <!-- END -->

                                    <!-- TEXT -->
                                    <div class="chat">
                                        <div id="someone_typing" hidden v-if="typing"
                                             style="position: fixed;bottom: 55px;">
                                            <div v-for="user in typingUserName">@{{ user }},</div>
                                            님이 입력 중 입니다..
                                        </div>
                                        <form v-on:submit.prevent="messageFormSubmit()" id="messageForm"
                                              class="form-wrapper cf">
                                            <input @keydown="isTyping" style="width:100%" type="text"
                                                   autocomplete=off
                                                   id="message"
                                                   placeholder="{{Auth::user()->name}}" autofocus>
                                        </form>
                                    </div>
                                    <!-- END -->
                                </div>
                                <!-- END -->
                            </div>
                            <!-- END -->


                        </div>
                    </div>

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


        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        function onYouTubeIframeAPIReady() {

            for (var i = 0; i < chatting_app.chats.length; i++) {
                if (chatting_app.chats[i].social === 2) {
                    console.log("youtube generated" + chatting_app.chats[i].id);
                    var curplayer = chatting_app.createPlayer(chatting_app.chats[i]);
                }
            }
        }

        var chatting_app = new Vue({
            el: '#chatting',
            data: {
                typingUserName: [],
                typing: false,
                viewers: {},

                teamsPowerWidth: [],
                page: 1,
                chats: [],
                maxChatId: "{{ $maxChatId }}",

                myLike: [
                    @foreach($likes as $like)
                    {{ $like }},
                    @endforeach
                ],
                busy: false,
                chatIdOffset: {{ $maxChatId }} +1,
                isFirstLoad: true,
                chat_only: ''

            },

            created: function () {

                console.log(this.myLike);


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


                createPlayer: function (chat) {
                    return new YT.Player("youtube_" + chat.id, {
                        height: 400,
                        width: 600,
                        videoId: chat.picture
                    });
                },

                chatOnly: function () {
                    this.chat_only = "?chat_only=true";
                    this.chats = [];
                    $('#content-section')[0].scrollTop = $('#content-section')[0].scrollHeight;
                    this.loadMore();
                }
                ,
                loadMore: function () {

                    console.log('called');

                    if (this.busy) {
                        // 다른게 로딩하고 있다면 이거는 완료 됐다 하고 리턴
                        setTimeout(() => {
                            this.$refs.infiniteLoading.$emit('$InfiniteLoading:loaded');
                        }, 100);
                        return;
                    }

                    // 다른 것(처음 로딩) 도는 중
                    this.busy = true;

                    setTimeout(() => {


                        request = '/chat_content/{{ $ssul->id }}/' + this.chatIdOffset + this.chat_only;

                        console.log(request);
                        axios.get(request, {
                            'page': this.page
                        })
                            .then((response) => {
                                this.page++;

                                chatting_app.chats = response.data.concat(chatting_app.chats);


                                console.log(this.isFirstLoad);
                                console.log(this.chats);


                                if (response.data.length > 0) {
                                    console.log("first???????");
                                    console.log(this.isFirstLoad);
                                    console.log("first???????");

                                    if (this.isFirstLoad) {
                                        setTimeout(() => {
                                            $('#content-section')[0].scrollTop = $('#content-section')[0].scrollHeight;
                                            this.isFirstLoad = false;
                                            this.busy = false;
                                            console.log("first Loaded!!!!!!!!!");
                                        }, 10);

                                    } else {
                                        console.log("first not!");
                                        $('#content-section')[0].scrollTop = $("#chatrow" + this.chats[response.data.length].id)[0].scrollHeight + 800;
                                        this.busy = false;

                                    }
                                    this.$refs.infiniteLoading.$emit('$InfiniteLoading:loaded');
                                } else {
                                    this.$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                                }

                                this.chatIdOffset = this.chats[0].id;
                                console.log(this.chatIdOffset);
                            });


                    }, 100);

                }
                ,

                isTyping: function () {
                    let channel = Echo.join('isTyping{{$ssul->id}}');

                    setTimeout(function () {
//                        console.log('whisper!!');
                        channel.whisper('isTyping', {
                            name: "{{ $user->name }}",
                            typing: true
                        })
                    }, 300);


//                    console.log('listen whisper!!');
                    channel.listenForWhisper('isTyping', (e) => {
//                        console.log(e.name);

//                        console.log(this.typingUserName);
                        if (e.typing === false) {
                            this.typingUserName.pop(e.name);
                        } else {
                            if (this.typingUserName.indexOf(e.name) == -1) {
                                this.typingUserName.push(e.name);
                            }
                        }
                        this.typing = e.typing;


                        setTimeout(function () {
                            chatting_app.typing = false;
                        }, 5000);
                    });
                }
                ,

                isNotTyping: function () {
                    let channel = Echo.join('isTyping{{$ssul->id}}');

//                    console.log('whisperStotp!!');
                    setTimeout(function () {
                        channel.whisper('isTyping', {
                            name: "{{ $user->name }}",
                            typing: false
                        });
                    }, 300);


                }
                ,


                submitMessage: function () {
                    this.isNotTyping();

                    var name = "{{ $user->name }}";
                    var message = $('#message').val();
                    $('#message').val(''); // 폼 초기화

                    data = {
                        'message': message,
                        'ipaddress': ip(),
                        'ssul_id': "{{ $ssul->id }}",
                        anony_name: localStorage['SsulChatAnonymous'],
                        'myTeam': "{{ $myTeam }}"
                    };

                    axios.post('/chat', data)
                        .then((response) => {
//                            console.log(response);
                        });
                }
                ,
                like: function (id) {
//                    console.log('like');
                    axios.post('/like', {
                        'chattingId': id,
                        'ssul_id': "{{$ssul->id}}"
                    })
                        .then((response) => {
//                                console.log(response);
                        });
                }
                ,
                messageFormSubmit: function () {
//                    console.log('hihihi');
                    setTimeout(chatting_app.submitMessage(), 0);
                    return false;
                }
                ,
                chatIdInMyLike: function (id) {
                    this.myLike.forEach(function (value) {
                        console.log('hererererer');
                        console.log(value);
                        console.log(id);
                        console.log('hererererer');
                        if (value == id) {
                            console.log("truururu");
                            return true;
                        }
                        else {
                            console.log("false!!!");
                            return false;
                        }
                    });
                }
                ,

            }
        })


    </script>




@endsection