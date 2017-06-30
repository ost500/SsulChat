@extends('layouts.header')
@section('content')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <body xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <style>
        dl.selectL, dl.selectR {
            transition: height 0.5s;
        }

        dl.selectL:hover, dl.selectR:hover {
            height: 125%;
        }
    </style>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        $('#element').on('scroll touchmove mousewheel', function (event) {
            event.preventDefault();
            event.stopPropagation();

            return false;
        });
    </script>
    <script>
        window.onload = function () {
            if (matchMedia("only screen and (max-device-width: 480px) and (min-device-width: 320px)").matches) {
                var outerheight = $(window).outerHeight(true) - $('.header_chat').outerHeight(true) - $('.chat_input_wrap').outerHeight(true) - 20
                var inner = $('.chat_txt_area2');

                $('.chat_txt_area2').css('height', outerheight);
                $('.chat_txt_area2').css('bottom', 0);
                $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
            } else {
                var outerheight = $(window).outerHeight(true) - $('.header_chat').outerHeight(true) - $('.chat_txt_area1').outerHeight(true) - $('.chat_input_wrap').outerHeight(true) - 20;
//                var rightSideBarheight = $(window).outerHeight(true) - $('.header_chat').outerHeight(true) - 20;
                var inner = $('.chat_txt_area2');

                $('.chat_txt_area2').css('height', outerheight);

                $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;

//                $('.chat_box').css('height', rightSideBarheight);
                $('.chat_box')[0].scrollTop = 0;

            }
            if (localStorage['SsulChatAnonymous'] !== undefined)
                localStorage.removeItem('SsulChatAnonymous');
//            if (localStorage['SsulChatAnonymous'] === undefined || localStorage['SsulChatAnonymous'] != '익명' + parseInt(ip().split('.').join('')).toString(16)) {
//                localStorage['SsulChatAnonymous'] = '익명' + parseInt(ip().split('.').join('')).toString(16);
//            }
        }
    </script>

    <script>
        $(window).resize(function () {
            if (matchMedia("only screen and (max-device-width: 480px) and (min-device-width: 320px)").matches) {
                var outerheight = $(window).outerHeight(true) - $('.chat_txt_area1').outerHeight(true) - $('.chat_input_wrap').outerHeight(true) - 20;
                var inner = $('.chat_txt_area2');

                $('.chat_txt_area2').css('height', outerheight);

                $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
            } else {
                var outerheight = $(window).outerHeight(true) - $('.header_chat').outerHeight(true) - $('.chat_txt_area1').outerHeight(true) - $('.chat_input_wrap').outerHeight(true) - 20;
//                var rightSideBarheight = $(window).outerHeight(true) - $('.header_chat').outerHeight(true) - 20;
                var inner = $('.chat_txt_area2');

                $('.chat_txt_area2').css('height', outerheight);

//                $('.chat_box').css('height', rightSideBarheight);
            }

        })
        $(document).ready(function () {
            $('.selectL, .selectR').hover(function (e) {
                if (e.target.children.length > 2) {
                    e.target.children[1].hidden = true;
                    e.target.children[2].hidden = false;
                }
                e.stopPropagation();
            });
            $('.selectL, .selectR').mouseleave(function (e) {
                if (e.target.children.length > 2) {
                    e.target.children[1].hidden = false;
                    e.target.children[2].hidden = true;
                }
                e.stopPropagation();
            });
            $('.selectL').click(function () {
                $('form.teamSelect')[0].teamSelect.value = {{ $thisChannel->ssul->teams[0]->id }};
                $('form.teamSelect').submit();
            });
            $('.selectR').click(function () {
                $('form.teamSelect')[0].teamSelect.value = {{ $thisChannel->ssul->teams[1]->id }};
                $('form.teamSelect').submit();
            });
        });

    </script>


    <div id="chatting">
        <div class="header_chat">
            <ul class="chat_top_hot">
                <li class="hot_01"><img src="/images/top_hot.png" alt="hot썰"></li>
                <li class="hot_02"><span class="hot_num"></span><span class="hot_txt">썰챗 베타서비스</span><span>
                        {{--<img src="/images/top_hot_btn.png" alt="핫썰 더보기">--}}
                    </span></li>
            </ul>
            <a href="{{ route('main') }}"><h1 style="z-index:10"><img src="/images/main_logo01.png" alt="썰챗 로고"></h1>
            </a>
            <div class="chat_search">
                @if(Auth::user()->annony == true)
                    <a href="{{ route("login") }}">
                        <button type="submit" style="background-image: url('/images/chatpic01.png');"></button>
                    </a>
                @else
                    <form method="post" action="{{ route("logout") }}">
                        {!! csrf_field() !!}
                        <button type="submit"
                                style="background-image: url({{Auth::user()->profile_img}});"></button>
                    </form>
                @endif

                <form class="form-wrapper cf" method="get" action="{{ route("search") }}">
                    <input type="text" name="question"
                           placeholder="찾고 싶은 주제를 검색하세요">
                </form>
                </a>
            </div>

        </div>

        <div class="clear"></div>
        <div class="contents_chat">
            <div class="chat_list">
                {{--<h2>All Threads</h2>--}}
                <dl class="chann">
                    <dt>썰방<span>({{ $ssuls->count() }})</span><span class="chat_more"><a href="#"><img
                                        src="/images/chat_icon05.png"
                                        alt="더보기"></a></span></dt>
                    <dd>
                        <a href="#"><span class="ddf">{{ $thisChannel->ssul->name }}</span></a>
                    @foreach($thisChannel->ssul->channels as $num => $channel)
                        @if($channel->id == $thisChannel->id)
                            <dd>
                                <a v-cloak href="{{ route('chattingsWithChannel',['id' => $thisChannel->ssul->id, 'channelId' => $channel->id]) }}"><span
                                            class="ddt">-->{{ $num+1 }}번 채널 (@{{ viewers.length }})</span></a></dd>
                        @else
                            <dd>
                                <a href="{{ route('chattingsWithChannel',['id' => $thisChannel->ssul->id, 'channelId' => $channel->id]) }}"><span
                                            class="ddt">{{ $num+1 }}번 채널</span></a></dd>
                            @endif
                            @endforeach
                            </dd>
                            @foreach($ssuls as $ssul)
                                @if($ssul->id == $thisChannel->ssul->id)
                                    @continue
                                @endif
                                <dd>
                                    <a href="{{ route('chattings',['id' => $ssul->id]) }}"><span
                                                class="ddf">{{ str_limit($ssul->name, 30)}}</span></a>

                                </dd>
                                {{--<dd class="active"><a href="#"><span class="dds">general</span></a></dd>--}}
                                {{--<dd><a href="#"><span class="ddt">wiki</span></a></dd>--}}
                            @endforeach
                </dl>
                <dl class="message">
                    <dt v-cloak>참석자 (@{{ viewers.length  }})<span class="chat_more"><a href="#"><img
                                        src="/images/chat_icon05.png" alt="더보기"></a></span>
                    </dt>

                    <dd v-for="viewer in viewers">
                        <a href="#"><span v-cloak class="mess_icon01">@{{ viewer.name }}</span></a>
                    </dd>

                </dl>
                <div class="chat_left_menu">
                    <p><a href="#"><img src="/images/chat_left_menu.png" alt="메뉴"></a></p>
                </div>
            </div>


            <div class="chat_txt">

                <div class="chat_txt_area1">
                    <!-- TestADS -->
                    <!-- ssulchat/chattings/1/1 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-8665007420370986"
                         data-ad-slot="4947953757"
                         data-ad-format="auto"></ins>
                    <form method="post" action="{{ route('team_select') }}" class="teamSelect">
                        {!! csrf_field() !!}
                        <div class="graph" data-toggle="modal" data-target=".bs-example-modal-sm">
                            <dl class="selectL" v-bind:style="{width:teamsPower[0]+'%'}">
                                <dt>{{ $thisChannel->ssul->teams[0]->name }}</dt>
                                <dd v-cloak id="teamApower">@{{ teamsPower[0] }}%</dd>
                                <dd id="select" hidden>선택하기</dd>
                            </dl>
                            <dl class="selectR" v-bind:style="{width:teamsPower[1]+'%'}">
                                <dt>{{ $thisChannel->ssul->teams[1]->name }}</dt>
                                <dd v-cloak id="teamBpower">@{{ teamsPower[1] }}%</dd>
                                <dd id="select" hidden>선택하기</dd>
                            </dl>
                        </div>
                        <input type="hidden" name="teamSelect">
                    </form>
                    <!--<p class="chat_txt_area1_txt01">#general</p>
                    <p><span class="chat_txt_area1_txt02">ost</span> created htis channel on May 21st. This is hte very beginning of the <span class="chat_txt_area1_txt03">#general</span> channel.<br>
                    Purpose: <span class="chat_txt_area1_txt04">This channel is for team-wide communication and announcements. All team members are in the channel.</span> (<a href="#"><span class="chat_txt_area1_txt03">edit</span></a>)</p><br>
                    <a href="#"><span class="chat_txt_area1_txt03">+ Add an app or custom integration</span></a><a href="#"><span class="chat_txt_area1_txt03 chat_txt_area1_txt05">Invite others to this channel</span></a> -->
                </div>


                <div id="chats" class="chat_txt_area2">
                    {{--<span class="chat_date">May 21st</span>--}}


                    <infinite-loading :on-infinite="loadMore" ref="infiniteLoading" direction="top"></infinite-loading>
                    <ul v-for="chat in chats" class="normal_chat" v-bind:id="chat.id">
                        <li class="chat_pic" v-bind:id="'chatrow'+chat.id">

                            <div v-if="chat.user.profile_img == null" class="chat_profile_img"
                                 style="background-image: url('/images/chatpic01.png');"></div>

                            <div v-else class="chat_profile_img"
                                 :style="{'background-image': 'url('+chat.user.profile_img+')'}"></div>


                        </li>

                        <li v-cloak class="chat_id v-cloak--hidden">@{{chat.user.name}}
                            <span v-cloak > @{{chat.created_at}}</span><span>@{{chat.ipaddress}}</span></li>
                        <li v-cloak class="chat_text"> @{{chat.content}}
                            <button style="border:0;background:transparent;margin-left:1%"
                                    v-on:click="like(chat.id)">


                                <div v-if="chat.myLike">
                                    <img src="/images/like.png" style="width: 55%;">
                                    <h5  v-cloak style="float:right;font-weight: bold;color:#D75A4A">@{{chat.likes.length}}</h5>
                                </div>

                                <div v-else>
                                    <img src="/images/like_blank.png" style="width: 55%;">
                                    <h5 v-cloak style="float:right">@{{ chat.likes.length }}</h5>
                                </div>

                            </button>
                        </li>
                    </ul>

                    <!-- 채팅생성영역-->

                </div>

                <div id="someone_typing" hidden v-if="typing" style="position: fixed;bottom: 55px;">
                    <div v-for="user in typingUserName">@{{ user }},</div>
                    님이 입력 중 입니다..
                </div>


                <div class="chat_input_wrap">
                    <form v-on:submit.prevent="messageFormSubmit()" id="messageForm" class="form-wrapper cf">
                        <input type='file' name="a" id="a" style="display:none;"/>
                        <input type="button" onclick="document.getElementById('a').click();" class="chat_file">
                        <input id="message" type="text" placeholder="당신의 의견은?" class="chat_input" autocomplete=off
                               @keydown="isTyping">
                    </form>
                </div>
            </div>

            <div class="chat_box" style="overflow-y:auto">
                @foreach($popularChats as $popularChat)
                    <ul class="gry_box">
                        <li class="grybox_pf_img">
                            @if($popularChat->user->profile_img != null)
                                <div class="pf_img"
                                     style="background-image: url({{$popularChat->user->profile_img}});"></div>
                            @else
                                <div class="pf_img"
                                     style="background-image: url('/images/chatpic01.png');"></div>
                            @endif
                        </li>
                        <li class="grybox_sj">{{ $popularChat->user->name }}</li>
                        <li class="grybox_good">{{ $popularChat->likes_count }}</li>
                        <li class="grybox_txt clear">{{ $popularChat->content }}
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

    {{--<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
    {{--aria-hidden="true">&times;</span></button>--}}
    {{--<h4 class="modal-title">진영 선택</h4>--}}
    {{--</div>--}}
    {{--<form method="post" action="{{ route('team_select') }}">--}}
    {{--{!! csrf_field() !!}--}}
    {{--<div class="modal-body">--}}
    {{--<div class="radio">--}}
    {{--<label>--}}

    {{--<input type="radio" name="teamSelect" id="optionsRadios1"--}}
    {{--value="{{ $thisChannel->ssul->teams[0]->id }}" checked>--}}
    {{--{{ $thisChannel->ssul->teams[0]->name }}--}}
    {{--</label>--}}
    {{--</div>--}}
    {{--<div class="radio">--}}
    {{--<label>--}}
    {{--<input type="radio" name="teamSelect" id="optionsRadios2"--}}
    {{--value="{{ $thisChannel->ssul->teams[1]->id }}">--}}
    {{--{{ $thisChannel->ssul->teams[1]->name }}--}}
    {{--</label>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>--}}
    {{--<button type="submit" class="btn btn-primary">확인</button>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div><!-- /.modal-content -->--}}
    {{--</div><!-- /.modal-dialog -->--}}
    {{--</div>--}}

    </body>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
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
                teamsPower: [{{ $teamAPower }},{{ 100 - $teamAPower}}],
                page: 1,
                chats: [],
                maxChatId: "{{ $maxChatId }}",
                myLike: [
                    @foreach($likes as $like)
                    {{ $like }},
                    @endforeach
                ],
                busy: false,
                chatIdOffset: "{{ $maxChatId }}"

            },
            filters: {
                ifMyLike: function (value) {
                    return this.myLike.indexof(value) > -1 ? true : false;
                }
            },

            created: function () {

                console.log(this.myLike);

                this.getChat();

                Echo.join('newMessage{{$thisChannel->id}}').listen('.testing', (e) => {


                    this.chats.push(e);

                    this.maxChatId = e.id;


                    // 맨 아래로 스크롤 이동
                    setTimeout(() => {
                        $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
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


                Echo.join('newMessage{{$thisChannel->id}}').listen('.like', (e) => {
                    console.log(e);
                    // 하트 채우기
                    if (e.available) {

                        this.myLike.push(e.chattingId);
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

                        targeId = null;


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

                    this.teamsPower = e.teamsPower;
                });

                $("#someone_typing").show();
            },

            methods: {
                loadMore: function () {
                    if (this.chats != null) {
                        setTimeout(() => {

                            request = '/chat_content/{{ $thisChannel->id }}/' + this.chats[0].id;

                            let pastChatZeroId = this.chats[0].id;

                            console.log(request);
                            axios.get(request, {
                                'page': this.page
                            })
                                .then((response) => {
                                    this.page++;

                                    console.log("here");

                                    console.log("there");


                                    chatting_app.chats = response.data.concat(chatting_app.chats);


                                    console.log(this.chats);
                                    if (response.data.length >= 20) {
                                        this.$refs.infiniteLoading.$emit('$InfiniteLoading:loaded');
                                        setTimeout(() => {
                                            $('.chat_txt_area2')[0].scrollTop = $("#chatrow" + this.chats[20].id)[0].scrollHeight + 800;
                                        }, 10);
                                    } else {
                                        this.$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
                                    }


//                            this.maxChatId;
                                });

                            this.busy = false;
                        }, 10);
                    }
                },

                isTyping: function () {
                    let channel = Echo.join('isTyping{{$thisChannel->id}}');

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
                },

                isNotTyping: function () {
                    let channel = Echo.join('isTyping{{$thisChannel->id}}');

//                    console.log('whisperStotp!!');
                    setTimeout(function () {
                        channel.whisper('isTyping', {
                            name: "{{ $user->name }}",
                            typing: false
                        });
                    }, 300);


                },


                submitMessage: function () {
                    this.isNotTyping();

                    var name = "{{ $user->name }}";
                    var message = $('#message').val();
                    $('#message').val(''); // 폼 초기화

                    data = {
                        'message': message,
                        'ipaddress': ip(),
                        'channel_id': "{{ $thisChannel->id }}",
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
                        'channel_id': "{{ $thisChannel->id }}",
                        'ssul_id': "{{$thisChannel->ssul->id}}"
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
                },
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
                },

                getChat: function () {
                    setTimeout(() => {
                        request = '/chat_content/{{ $thisChannel->id }}/' + this.maxChatId;

                        console.log(request);
                        axios.get(request, {
                            'page': this.page
                        })
                            .then((response) => {
                                this.page++;

                                console.log("here");
                                console.log(response.data);
                                console.log("there");

                                response.data.forEach(function (value) {
                                    chatting_app.chats.push(value);
                                });


                                console.log(this.chats);
                                setTimeout(() => {
                                    $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
                                }, 100);
//                            this.maxChatId;
                            });

                    }, 1000);
                }
            }
        })


    </script>

@endsection