@extends('layouts.header')
@section('content')
    <body>
    <div id="wrap">
        <div class="header_main">
            <h1><img src="images/main_logo02.png" alt="썰챗로고"></h1>
            <form>
                <input type="text">
            </form>
        </div>

        <div class="community_wrap">
            <div class="community">
                <h2>커뮤니티 인기글</h2>
                <div>
                    @foreach($channels as $num => $channel)
                        <ul>
                            <li class="comm_num">{{ $num + 1 }}</li>
                            <li class="comm_thumbnail"><img src="/images/comm_pic01.png"></li>
                            <li class="comm_subject">{{ $channel->name }}<img
                                        src="/images/comm_icon01.png"><span>[86]</span>
                            </li>
                            <li class="comm_info"><span><img
                                            src="/images/comm_icon02.png"></span><span>자유</span><span>19시간 전</span><span>Zest</span>
                            </li>
                        </ul>
                    @endforeach
                    {{--<ul>--}}
                    {{--<li class="comm_num">2</li>--}}
                    {{--<li class="comm_thumbnail"><img src="images/comm_pic02.png"></li>--}}
                    {{--<li class="comm_subject">[신규 기능] 인게임 정보에서 아이템 빌드를 확인하세요.<img src="images/comm_icon01.png"><span>[32]</span>--}}
                    {{--</li>--}}
                    {{--<li class="comm_info"><span><img--}}
                    {{--src="images/comm_icon02.png"></span><span>정보</span><span>20시간 전</span><span>갓피지지찬양해</span>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--<ul>--}}
                    {{--<li class="comm_num">3</li>--}}
                    {{--<li class="comm_thumbnail"><img src="images/comm_pic03.png"></li>--}}
                    {{--<li class="comm_subject">롤 자막 패러디 [광고없음]<span>[10]</span></li>--}}
                    {{--<li class="comm_info"><span><img--}}
                    {{--src="images/comm_icon03.png"></span><span>영상</span><span>7시간 전</span><span>japan</span>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--<ul>--}}
                    {{--<li class="comm_num">4</li>--}}
                    {{--<li class="comm_thumbnail"><img src="images/comm_pic02.png"></li>--}}
                    {{--<li class="comm_subject">롤 자막 패러디 [광고없음]<span>[10]</span></li>--}}
                    {{--<li class="comm_info"><span><img--}}
                    {{--src="images/comm_icon03.png"></span><span>영상</span><span>7시간 전</span><span>japan</span>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                </div>
            </div>
        </div>

        <a href="#">
            <div class="chat_btn"></div>
        </a>

    </div>
    </body>
@endsection
