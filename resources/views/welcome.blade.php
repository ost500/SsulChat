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

<meta name="csrf-token" content="{{ csrf_token() }}">
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
<div id="app">
<div class="chat"></div>
    <form class="form">
        @if (Auth::guest())
            <input type="text" id="name" placeholder="닉네임" value="" readonly="true"/>
        @else
            <input type="text" id="name" placeholder="닉네임" value="{{ Auth::user()->name }}" readonly="true"/>
        @endif
        <input type="text" id="message" placeholder="메세지를 입력해주세요." autofocus/>
        <button type="submit">보내기</button>
    </form>
</div>

</body>


<script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>


<script>

    var submitMessage = function () {
        var name = $('#name').val();
        var message = $('#message').val();
        $('#message').val(''); // 폼 초기화
//        app.message('send.message', {name: name, message: message});

        axios.post('/task', {'message': message})
            .then((response) => {
//                console.log(response);


            });


    };
    $('form').bind('submit', function () {
        setTimeout(submitMessage, 0);
        return false;
    });

    //    Echo.channel('test2').listen('.test2Event', (e) => {
    //        console.log('test2EventLog');
    //        console.log(e);
    //    });
    //    Echo.channel('try').listen('.ggg', (e) => {
    //        console.log('zxc');
    //        console.log(e);
    //    });
    Echo.join('testing').listen('.testing', (e) => {
//        console.log('abc');
        console.log(e);
        $('div.chat').append('<div class="item"><div class="name">' + '</div>' +
            '<div class="message">' + e.message + '</div></div>');

        // 맨 아래로 스크롤 이동
        $('div.chat').scrollTop($('div.chat')[0].scrollHeight);
    });


    //    Echo.channel('channel-name').listen('.server.created', (e) => {
    //        console.log('123');
    //        console.log(e);
    //    });

</script>
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
</html>
