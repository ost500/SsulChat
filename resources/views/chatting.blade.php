@extends('layouts.header')
@section('content')
    <body xmlns:v-on="http://www.w3.org/1999/xhtml">
    <script>
        window.onload = function () {
            if (matchMedia("only screen and (max-device-width: 480px) and (min-device-width: 320px)").matches) {
                var outerheight = $(window).outerHeight(true) - $('.chat_txt_area1').outerHeight(true) - $('.chat_input_wrap').outerHeight(true) - 20;
                var inner = $('.chat_txt_area2');

                $('.chat_txt_area2').css('height', outerheight);

                $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
            } else {
                var outerheight = $(window).outerHeight(true) - $('.header_chat').outerHeight(true) - $('.chat_txt_area1').outerHeight(true) - $('.chat_input_wrap').outerHeight(true) - 20;
                var inner = $('.chat_txt_area2');

                $('.chat_txt_area2').css('height', outerheight);

                $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
            }
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
                var inner = $('.chat_txt_area2');

                $('.chat_txt_area2').css('height', outerheight);

                $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
            }

        })
    </script>


    <div id="chatting">
        <div class="header_chat">
            <ul class="chat_top_hot">
                <li class="hot_01"><img src="/images/top_hot.png" alt="hot썰"></li>
                <li class="hot_02"><span class="hot_num">13</span><span class="hot_txt">박근혜 오늘의 법정에서</span><span><img
                                src="/images/top_hot_btn.png" alt="핫썰 더보기"></span></li>
            </ul>
            <h1><a href="#"><img src="/images/main_logo01.png" alt="썰챗 로고"></a></h1>
            <div class="chat_search">
                <form class="form-wrapper cf">
                    <input type="text" onfocus="if(this.value =='찾고 싶은 주제를 검색하세요') this.value='';"
                           onblur="if(this.value =='') this.value='찾고 싶은 주제를 검색하세요';" value="찾고 싶은 주제를 검색하세요">
                </form>
                <button type="submit"><img src="/images/main_search_btn01.png" alt="검색하기"></button>
            </div>

        </div>

        <div class="clear"></div>
        <div class="contents_chat">
            <div class="chat_list">
                {{--<h2>All Threads</h2>--}}
                <dl class="chann">
                    <dt>CHANNELS<span>({{ $ssuls->count() }})</span><span class="chat_more"><a href="#"><img
                                        src="/images/chat_icon05.png"
                                        alt="더보기"></a></span></dt>
                    <dd>
                        <a href="#"><span class="ddf">{{ str_limit($thisChannel->ssul->name, 30)}}</span></a>
                    @foreach($thisChannel->ssul->channels as $num => $channel)
                        @if($channel->id == $thisChannel->id)
                            <dd><a href="#"><span class="ddt">-->{{ $num+1 }}번 채널</span></a></dd>
                        @else
                            <dd><a href="#"><span class="ddt">{{ $num+1 }}번 채널</span></a></dd>
                            @endif
                            @endforeach
                            </dd>

                            @foreach($ssuls as  $ssul)
                                @if($ssul->id == $thisChannel->ssul->id)
                                    @continue
                                @endif
                                <dd>
                                    <a href="#"><span class="ddf">{{ str_limit($ssul->name, 30)}}</span></a>
                                @foreach($ssul->channels as $num => $channel)
                                    <dd><a href="#"><span class="ddt">{{ $num+1 }}번 채널</span></a></dd>
                                    @endforeach
                                    </dd>
                                    {{--<dd class="active"><a href="#"><span class="dds">general</span></a></dd>--}}
                                    {{--<dd><a href="#"><span class="ddt">wiki</span></a></dd>--}}
                                @endforeach
                </dl>
                <dl class="message">
                    <dt>DIRECT MESSAGES<span class="chat_more"><a href="#"><img src="/images/chat_icon05.png" alt="더보기"></a></span>
                    </dt>
                    <dd><a href="#"><span class="mess_icon01">slackbot</span></a></dd>
                    <dd><a href="#"><span class="mess_icon02">ruin_alen(you)</span><img class="mess_pic"
                                                                                        src="/images/chat_icon10.png"></a>
                    </dd>
                    <dd><a href="#"><span class="mess_icon02">obie</span></a></dd>
                    <dd><a href="#"><span class="mess_icon02">ost</span></a></dd>
                    <dd><a href="#"><span class="mess_icon03">t0dd</span></a></dd>
                    <dd><a href="#"><span class="invite">+ Invite people</span></a></dd>
                </dl>
                <div class="chat_left_menu">
                    <p><a href="#"><img src="/images/chat_left_menu.png" alt="메뉴"></a></p>
                </div>
            </div>


            <div class="chat_txt">
                <div class="chat_txt_area1">
                    <div class="graph">

                        <dl class="selectL" style="width:35%">
                            <dt>{{ $thisChannel->ssul->teams[0]->name }}</dt>
                            <dd>{{ $thisChannel->ssul->teams[0]->value }}%</dd>
                        </dl>
                        <dl class="selectR" style="width:65%">
                            <dt>{{ $thisChannel->ssul->teams[1]->name }}</dt>
                            <dd>{{ $thisChannel->ssul->teams[1]->value }}%</dd>
                        </dl>

                    </div>
                    <!--<p class="chat_txt_area1_txt01">#general</p>
                    <p><span class="chat_txt_area1_txt02">ost</span> created htis channel on May 21st. This is hte very beginning of the <span class="chat_txt_area1_txt03">#general</span> channel.<br>
                    Purpose: <span class="chat_txt_area1_txt04">This channel is for team-wide communication and announcements. All team members are in the channel.</span> (<a href="#"><span class="chat_txt_area1_txt03">edit</span></a>)</p><br>
                    <a href="#"><span class="chat_txt_area1_txt03">+ Add an app or custom integration</span></a><a href="#"><span class="chat_txt_area1_txt03 chat_txt_area1_txt05">Invite others to this channel</span></a> -->
                </div>


                <div id="chats" class="chat_txt_area2">
                    <span class="chat_date">May 21st</span>
                    @foreach($chats as $chat)
                        <ul id="{{$chat->id}}">
                            <li class="chat_pic">
                                <div class="chat_profile_img"
                                     style="background-image: url('/images/chatpic01.png');"></div>
                            </li>
                            <li class="chat_id">{{$chat->user->name}}
                                <span> {{$chat->created_at}}</span><span>{{$chat->ipaddress}}</span></li>
                            <li class="chat_text"> {{$chat->content}}
                                <button style="border:0;background:transparent;margin-left:2%" v-on:click="like('{{$chat->id}}')">
                                    <img src="/images/gry_box_icon.png"></img>
                                    <div style="float:right">{{$chat->likes->count()}}</div>
                                </button>
                            </li>
                        </ul>
                @endforeach
                <!-- 채팅생성영역-->
                </div>
                <div class="chat_input_wrap">
                    <form v-on:submit.prevent="messageFormSubmit()" id="messageForm" class="form-wrapper cf">
                        <input type='file' name="a" id="a" style="display:none;"/>
                        <input type="button" onclick="document.getElementById('a').click();" class="chat_file">
                        <input id="message" type="text" placeholder="당신의 의견은?" class="chat_input" autocomplete=off>
                    </form>
                </div>
            </div>


            @foreach($popularChats as $popularChat)
                <div class="chat_box">
                    <ul class="gry_box">
                        <li class="grybox_sj">{{ $popularChat->user->name }}</li>
                        <li class="grybox_good">{{ $popularChat->likes_count }}</li>
                        <li class="grybox_txt clear">{{ $popularChat->content }}
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
    </body>

    <script type="text/javascript" src="http://jsgetip.appspot.com"></script>
    <script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>




    <script>

    </script>

    <script>

        var chatting_app = new Vue({
            el: '#chatting',
            data: {},
            mounted: function () {

                Echo.join('newMessage{{$thisChannel->id}}').listen('.testing', (e) => {
                    //console.log(e);

                    $('#chats').append("<ul id=" + e.id + ">" +
                        "<li class=\"chat_pic\"><div class=\"chat_profile_img\" style=\"background-image: url(\'/images/chatpic01.png\')\"></div></li>" +
                        "<li class=\"chat_id\">" + e.userName + "<span>" + e.time + "</span><span>" + e.ipAddress + "</span></li>" +
                        "<li class=\"chat_text\">" + e.message + "<button style=\"border:0;background:transparent;margin-left: 2%;\" onclick=\"chatting_app.like("+e.id+")\"><img src=\"/images/gry_box_icon.png\"></img><div style=\"float:right\">0</div></button></li>" +
                        "</ul>");
                    $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;

                    // 맨 아래로 스크롤 이동

                });
                Echo.join('newMessage{{$thisChannel->id}}').listen('.like', (e) => {
                    //console.log(e);
                    $('#chats ul#' + e.chattingId)[0].children[2].children[0].children[1].innerHTML = parseInt($('#chats ul#' + e.chattingId)[0].children[2].children[0].children[1].innerHTML) + 1;
                    // 맨 아래로 스크롤 이동
                    $('.chat_txt_area2')[0].scrollTop = $('.chat_txt_area2')[0].scrollHeight;
                });
            },

            methods: {
                submitMessage: function () {
                    var name = $('#name').val();
                    var message = $('#message').val();
                    $('#message').val(''); // 폼 초기화


                    axios.post('/chat', {'message': message, 'ipaddress': ip(), 'channel_id': "{{ $thisChannel->id }}"})
                        .then((response) => {
                            console.log(response);
                        });
                },
                like: function (id) {
                    console.log('like');
                    axios.post('/like', {'chattingId': id, 'channel_id': "{{ $thisChannel->id }}"})
                        .then((response) => {
//                                console.log(response);
                        });
                },
                messageFormSubmit: function () {
                    console.log('hihihi');
                    setTimeout(chatting_app.submitMessage(), 0);
                    return false;
                }
            }
        })


    </script>

@endsection