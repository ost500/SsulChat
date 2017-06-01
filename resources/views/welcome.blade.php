<!DOCTYPE html>
<!--//
This web page has been developed by Wani.
 - me@wani.kr
 - http://wani.kr
-->
<!--[if lt IE 7]>
<html class="ie6" lang="ko"><![endif]-->
<!--[if IE 7]>
<html class="ie7" lang="ko"><![endif]-->
<!--[if IE 8]>
<html class="ie8" lang="ko"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ko"><!--<![endif]-->
<head>
    <title>Your Title</title>
    <meta charset="utf-8"/>

    <style>
        div.chat {
            border: 1px solid #aaa;
            width: 100%;
            height: 400px;
            overflow: scroll;
        }

        div.chat div.item + div.item {
            margin-top: 20px;
        }

        div.chat div.name {
            font-size: 14px;
            color: #999;
        }

        div.chat div.message {
            font-size: 16px;
            color: #333;
        }
    </style>
    <script type="text/javascript" src="http://jsgetip.appspot.com"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>
<body>
<!-- TestADS -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-8665007420370986"
     data-ad-slot="6492176154"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<div class="chat"></div>

<form class="form">
    @if (Auth::guest())
        <input type="text" id="name" placeholder="닉네임" value="" readonly="true" />
    @else
        <input type="text" id="name" placeholder="닉네임" value="{{ Auth::user()->name }}" readonly="true"/>
    @endif
    <input type="text" id="message" placeholder="메세지를 입력해주세요." autofocus/>
    <button type="submit">보내기</button>
</form>


<script src="/js/brain-socket-js/brain-socket.min.js"></script>
<script>
    (function (global, $, BrainSocket) {
        // (3-2) 앱 연결, 메시지 보내기
        var app = new BrainSocket(
            new WebSocket('ws://homestead.app:8080'),
            new BrainSocketPubSub()
        );
        console.log(app);
        var submitMessage = function () {
            var name = $('#name').val();
            var message = $('#message').val();
            var ipaddress = ip();
            $('#message').val(''); // 폼 초기화
            @if(Auth::guest())
                app.message('send.message', {name: null, message: message, ip: ipaddress, user_id: 1});
            @else
                app.message('send.message', {name: name, message: message, ip: ipaddress, user_id: {{Auth::user()->id}}}
            );
            @endif
        };
        $('form').bind('submit', function () {
            setTimeout(submitMessage, 0);
            return false;
        });

        // (3-3) 수신된 메시지 처리
        app.Event.listen('receive.message', function (msg) {
        // 본문 추가
            $('div.chat').append('<div class="item"><div class="name">' + msg.server.data.name + '</div>' +
                '<div class="message">' + msg.server.data.message + '</div></div>');
        // 맨 아래로 스크롤 이동
            $('div.chat').scrollTop($('div.chat')[0].scrollHeight);
        });
    })(this, jQuery, BrainSocket);
    @if(Auth::guest())
        $('input#name')[0].value = ip();
    @endif
</script>
</body>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-99980515-1', 'auto');
    ga('send', 'pageview');

</script>
</html>
