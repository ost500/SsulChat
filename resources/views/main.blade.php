@extends('layouts.header')
@section('content')
    <body>
    <div id="wrap">
        <div class="header_main">
            <h1><img src="images/main_logo02.png" alt="썰챗로고"></h1>
            <form method="get" action="{{ route('search') }}">


                @if(isset($question))
                    <input class="typeahead" autofocus type="text" name="question"
                           autocomplete="off"
                           value="{{ $question }}">

                @else
                    <input class="typeahead" autofocus type="text" name="question"
                           autocomplete="off">

                @endif

            </form>
        </div>

        <div class="community_wrap">
            <div class="community">
                <div style="margin:5px; text-align: center" class="make_ssul">
                    <a href="{{ route('ssul') }}">
                        <button type="submit" class="btn btn-primary">썰방 만들기</button>
                    </a>
                </div>
                <h2>썰방 리스트</h2>
                <div>
                    @if($channels->isEmpty())
                        <ul>검색 결과가 없습니다</ul>
                    @endif
                    @foreach($channels as $num => $channel)
                        <ul><a href="{{ route('chattings',['id'=>$channel->id]) }}">
                                <li class="comm_num">{{ $channels->firstItem() + $num }}</li>
                                <li class="comm_thumbnail"><img src="/images/comm_pic01.png"></li>
                                <li class="comm_subject">{{ $channel->name }}<span>
                                    @if(isset($channel->chat_count))
                                            [{{ $channel->chat_count }}]
                                        @endif</span>
                                </li>
                                <li class="comm_info"><span><img
                                                src="/images/comm_icon02.png"></span><span>자유</span><span>19시간 전</span><span>Zest</span>
                                </li>
                            </a>
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

            <div style=" text-align: center">
                {!! $channels->links() !!}
            </div>

        </div>


        <a href="#">
            <div class="chat_btn"></div>
        </a>

    </div>
    </body>

    <script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="/js/bootstrap3-typeahead.js"></script>

    <script type="text/javascript">
        $('.typeahead').typeahead('destroy');

        var $input = $(".typeahead");
        $input.typeahead({
            source: function (query, process) {

                axios.get('/search_json', {
                    'keyword': query
                })
                    .then((response) => {
                        console.log(response);
                        return process(response.data);
                    });
            },
            autoSelect: true,
            show: function () {
                var pos = $.extend({}, this.$element.position(), {
                    height: this.$element[0].offsetHeight,
                    left: "50%"
                })
            },

        });
    </script>
@endsection
