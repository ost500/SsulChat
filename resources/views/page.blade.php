@extends('layouts.app')
@section('content')


    <style>
        #chartdiv {

            width: 100%;
            height: 300px;
            margin-bottom: 50px;
        }

        #chartdiv2 {
            margin-bottom: 50px;
            width: 100%;
            height: 300px;
        }


    </style>
    <!-- PAGE HEADER -->
    <section class="gl-page-header-wrapper" style="background: url('{{ $page->background_picture }}')">
        <div class="container">
            <div class="row">
                <h1>{{ $page->title }}</h1>
                {{--<p><i class="ion-ios-location-outline"></i>Highway Road 3, Lane 56, California, USA</p>--}}
                <span class="gl-item-rating"><i class="ion-ios-star"></i>{{ $page->ssuls_count }}</span>

                <div class="gl-page-head-btn-wrapper">
                    <a data-remodal-target="modal-share" class="gl-btn gl-icon-btn gl-share-btn">공유하기</a>
                    @if($admin)
                        <a href="{{ route('pages.setting', ['id' => $page->id]) }}" class="gl-btn gl-icon-btn"><i
                                    class="fa fa-cog"></i>설정</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE HEADER -->




    <!-- PAGE CONTETNT -->
    <section class="gl-page-content-section gl-section-wrapper">

        <div class="container">

            <div class="row" id="chart">

                <div class="col-sm-6">
                    <div id="chartdiv"></div>
                </div>
                <div class="col-sm-6">
                    <div id="chartdiv2"></div>
                </div>


            </div>
        </div>
    </section>
    <!-- PAGE CONTETNT END -->


    <section class="gl-feat-listing-section gl-section-wrapper">
        <div class="container">

            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>{{$page->title}} 연관 검색어</h1>
                <p>오늘의 핫이슈</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                <div class="gl-element-wrapper gl-elements-page" style="margin-bottom: 130px;">
                    @foreach($morphs as $morph)
                        <a href="#" class="gl-tag-btn gl-design">{{ $morph->morph }} ({{ $morph->morph_count }})</a>
                    @endforeach
                </div>

            </div>


        </div>

    </section>
    <section class="gl-feat-listing-section gl-section-wrapper">
        <div class="container">

            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>{{$page->title}} 포스트</h1>
                <p>오늘의 핫이슈</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                @foreach($page->pagePosts as $num => $postItem)
                    @if(($num + 1) % 4 == 0)
                        <div class="row">

                            @endif
                            <div onclick="location.href='{{ route('pages', ['id' => $postItem->id]) }}'"
                                 class="gl-featured-items gl-featured-items-alt col-md-3 col-sm-3 col-xs-6">
                                <div class="gl-feat-items-img-wrapper">
                                    <picture>
                                        <source media="(min-width: 768px)" src="{{ $postItem->main_photo }}">
                                        <img alt="{{ $page->title }}" src="{{ $postItem->main_photo }}">
                                    </picture>


                                </div>

                                <div class="gl-feat-item-details">
                                    <h3>
                                        <a href="{{ route('pages', ['id' => $postItem->id]) }}">{{ str_limit($postItem->message, 20) }}</a>
                                    </h3>
                                    {{--<div class="gl-item-location">--}}

                                    {{--<span>{{ $page->description }}</span>--}}
                                    {{--</div>--}}


                                </div>


                            </div>
                            <!-- END -->
                            @if(($num + 1) % 4 == 0)
                        </div>
                    @endif
                @endforeach


            </div>
            <!-- MORE BTN -->
            <div class="gl-more-btn-wrapper">
                <a href="{{ route('pageList') }}" class="gl-more-btn gl-btn">더보기</a>
            </div>
            <!-- END -->

        </div>

    </section>


    <!-- FEATURED LISTINGS -->
    <section class="gl-feat-listing-section gl-section-wrapper">
        <div class="container">

            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>{{ $page->title }} 채팅방</h1>
                <p>오늘의 핫이슈</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                @foreach($page->ssuls as $num => $chatting)

                    @if(($num + 1) % 6 == 0)
                        <div class="row">
                        @endif
                        <!-- FEATURED ITEMS -->
                            <div onclick="location.href='{{ route('chattings',['name'=>$chatting->name]) }}'"
                                 class="gl-featured-items col-md-2 col-sm-2 col-xs-6 appear fadeIn"
                                 data-wow-duration="1s"
                                 data-wow-delay=".3s">
                                <div class="gl-feat-items-img-wrapper">

                                    <picture>
                                        <source media="(min-width: 768px)" src="{{ $chatting->picture }}">
                                        <img alt="{{ $chatting->name }}" src="{{ $chatting->picture }}">
                                    </picture>
                                </div>

                                <div class="gl-feat-item-details">
                                    <span class="gl-item-rating">
                                      <i class="ion-android-star-outline"></i>
                                        {{ $chatting->loginMembersCount }}
                                    </span>
                                    <h3>
                                        <a href="{{ route('pages.posts',['id'=>$chatting->id]) }}">{{ $chatting->name }}</a>
                                    </h3>

                                </div>
                            </div>
                            <!-- END -->
                            @if(($num + 1)%6 == 0)
                        </div>
                    @endif
                @endforeach


            </div>
            <!-- END -->


        </div>
    </section>
    <!-- FEATURED LISTINGS END -->

    <!-- FEATURED LISTINGS -->
    <section class="gl-feat-listing-section gl-section-wrapper">
        <div class="container">

            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>베스트 채팅</h1>
                <p>오늘의 핫이슈</p>
            </div>
            <!-- END -->


            <div class="gl-post-comments-wrapper">
                <h3 class="gl-blog-sec-title">Comments</h3>
                <!-- Reviews -->
                @foreach($likeBests as $best)
                    <div class="gl-comments">
                        <!-- USER IMG -->
                        <div class="gl-user-img">
                            <img src="{{ $best->profile_img }}" alt="User" class="gl-lazy">
                        </div>
                        <!-- END -->

                        <!-- TEXT -->
                        <div class="gl-comment-text">
                            <div class="gl-username-date">

                                <a href="{{ route('chattings', ['name' => $best->ssul_name]) }}">
                                    <h3>{{ $best->name }}</h3>
                                    <h3>{{ $best->ssul_name }}</h3>
                                    <span class="gl-comments-date">{{ $best->created_at }}</span>
                                </a>

                            </div>
                            <a href="{{ route('chattings', ['name' => $best->ssul_name]) }}"><img
                                        src="{{ $best->picture }}"></a>
                            <p>{{ $best->content }}</p>
                            {{--<a href="#" class="gl-reply">Reply</a>--}}
                        </div>
                        <!-- END -->
                    </div>
            @endforeach
            <!-- END -->
            </div>


        </div>
    </section>
    <!-- FEATURED LISTINGS END -->




    <!-- Chart code -->
    <script>
        var main = new Vue({
            el: '#chart',
            data: {
                statics_max_point: 0,
                morph_statics_max_point: 0,
                statics_list: [],
                morph_statics_list: []
            },
            created: function () {
                this.statics_load();
            },
            methods: {
                statics_load: function () {
                    axios.get('{{ route('pages.statistics',['id' => $page->id]) }}')
                        .then(function (response) {
                            console.log(response);

                            for (var i = 0, len = response.data.length; i < len; i++) {
                                var object = {
                                    "name": response.data[i].name,
                                    "points": response.data[i].countSsul,
                                    "color": "#" + ((1 << 24) * Math.random() | 0).toString(16),
                                    "bullet": response.data[i].picture
                                };
                                console.log(object);
                                main.statics_list.push(object);
                                console.log(main.statics_list);
                            }

                            main.statics_max_point = main.statics_list[0].points;
                            console.log(main.statics_max_point);


                            var chart = AmCharts.makeChart("chartdiv",
                                {
                                    "type": "serial",
                                    "theme": "light",
                                    "dataProvider": main.statics_list,
                                    "valueAxes": [{
                                        "maximum": main.statics_max_point + (main.statics_max_point * 0.2),
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

                    axios.get('{{ route('pages.morph_statistics',['id' => $page->id]) }}')
                        .then(function (response) {
                            console.log(response);

                            for (var i = 0, len = response.data.length; i < len; i++) {
                                var object = {
                                    "name": response.data[i].morph,
                                    "points": response.data[i].countMorphs,
                                    "color": "#" + ((1 << 24) * Math.random() | 0).toString(16),
                                    "bullet": response.data[i].picture
                                };
                                console.log(object);
                                main.morph_statics_list.push(object);
                                console.log(main.morph_statics_list);
                            }

                            main.morph_statics_max_point = main.morph_statics_list[0].points;
                            console.log(main.morph_statics_max_point);


                            var chart2 = AmCharts.makeChart("chartdiv2",
                                {
                                    "type": "serial",
                                    "theme": "light",
                                    "dataProvider": main.morph_statics_list,
                                    "valueAxes": [{
                                        "maximum": main.morph_statics_max_point,
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
        });
    </script>

@endsection