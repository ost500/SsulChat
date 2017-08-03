@extends('layouts.app')
@section('content')

    <style>
        #chartdiv {

            width: 100%;
            height: 300px;
        }

        #chartdiv2 {

            width: 100%;
            height: 300px;
        }


    </style>

    <!-- HERO IMAGE -->
    <section class="gl-hero-img-wrapper">
        <div class="container">
            <div class="row">
                <div class="gl-elements-content-wrapper">
                    <div id="typed-strings">
                        <p>모두의 <span class="gl-color-text">WIKICHAT</span></p>
                        <p>내가 만드는 <span class="gl-color-text">빅데이터</span></p>
                        {{--<p>Find The <span class="gl-color-text">Best Places</span> In Your City</p>--}}
                    </div>
                    <h2 id="gl-slogan" class="gl-hero-text-heading"></h2>
                    <p class="gl-hero-text-paragraph">아무말 대잔치</p>

                    <!-- DIRECTORY FORM -->
                    <div class="gl-directory-searchbar gl-bz-directory-searchbar">
                        <form action="{{ route('search') }}" id="gl-bz-directory-form">
                            <fieldset>
                                <input type="text" name="question" id="gl-business-keyword"
                                       class="gl-directory-input" placeholder="키워드" value="">


                            </fieldset>

                            <button type="submit" class="gl-icon-btn"><i class="fa fa-search"></i> 검색</button>
                        </form>
                    </div>
                    <!-- END -->

                </div>
            </div>
        </div>
    </section>


    <!-- FEATURED LISTINGS -->
    <section class="gl-feat-listing-section gl-section-wrapper">
        <div id="chart" class="container">

            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>이번주 위키챗</h1>
                <p>#빅데이터</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                <div class="row">
                    <div class="col-sm-6">
                        <div id="chartdiv"></div>
                    </div>
                    <div class="col-sm-6">
                        <div id="chartdiv2"></div>
                    </div>

                </div>
                <!-- MORE BTN -->
                <div class="gl-more-btn-wrapper">
                    <a href="{{ route('pageList') }}" class="gl-more-btn gl-btn">더보기</a>
                </div>
                <!-- END -->

            </div>

    </section><!-- FEATURED LISTINGS -->
    <section class="gl-feat-listing-section gl-section-wrapper">
        <div class="container">

            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>위키 페이지</h1>
                <p>오늘의 페이지</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                @foreach($pages as $num => $page)
                    @if(($num + 1) % 4 == 0)
                        <div class="row">
                            @endif
                            <div class="gl-featured-items gl-featured-items-alt col-md-3 col-sm-3 col-xs-6">
                                <div class="gl-feat-items-img-wrapper">
                                    <picture>
                                        <source media="(min-width: 768px)" srcset="{{ $page->main_picture }}">
                                        <img alt="Category Image" srcset="{{ $page->main_picture }}">
                                    </picture>


                                </div>

                                <div class="gl-feat-item-details">
                                    <h3>
                                        <a href="{{ route('pages', ['id' => $page->id]) }}">{{ $page->title }}</a>
                                    </h3>
                                    <div class="gl-item-location">

                                        <span>{{ $page->description }}</span>
                                    </div>


                                </div>

                                <div class="gl-feat-item-metas">
                                    <ul class="gl-feature-info">
                                        <li>구독자<span>3</span>
                                        </li>
                                        <li>채팅방<span>2</span>
                                        </li>

                                    </ul>
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
                <h1>위키 채팅</h1>
                <p>오늘의 핫이슈</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                @foreach($channels as $num => $channel)

                    @if(($num + 1) % 6 == 0)
                        <div class="row">
                        @endif
                        <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-2 col-sm-2 col-xs-6 appear fadeIn"
                                 data-wow-duration="1s"
                                 data-wow-delay=".3s">
                                <div class="gl-feat-items-img-wrapper">

                                    <picture>
                                        <source media="(min-width: 768px)" srcset="{{ $channel->picture }}">
                                        <img alt="{{ $channel->name }}" srcset="{{ $channel->picture }}">
                                    </picture>
                                </div>

                                <div class="gl-feat-item-details">
                            <span class="gl-item-rating">
                              <i class="ion-android-star-outline"></i>
                                @if(isset($channel->chat_count))
                                    {{ $channel->chat_count }}
                                @endif
                            </span>
                                    <h3>
                                        <a href="{{ route('chattings',['id'=>$channel->id]) }}">{{ $channel->name }}</a>
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

            <!-- MORE BTN -->
            <div class="gl-more-btn-wrapper">
                <a href="{{ route('chattingList') }}" class="gl-more-btn gl-btn">더보기</a>
            </div>
            <!-- END -->

        </div>
    </section>
    <!-- FEATURED LISTINGS END -->

    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all"/>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>




    <!-- Chart code -->
    <script>
        var main = new Vue({
            el: '#chart',
            data: {
                statics_max_point: 0,
                statics_list: []
            },
            created: function () {
                this.statics_load();
            },
            methods: {
                statics_load: function () {
                    axios.get('{{ route('statistics') }}')
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
                                        "maximum": main.statics_max_point+10,
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
                            var chart2 = AmCharts.makeChart("chartdiv2",
                                {
                                    "type": "serial",
                                    "theme": "light",
                                    "dataProvider": [{
                                        "name": "John",
                                        "points": 35654,
                                        "color": "#7F8DA9",
                                        "bullet": "https://www.amcharts.com/lib/images/faces/A04.png"
                                    }, {
                                        "name": "Damon",
                                        "points": 65456,
                                        "color": "#FEC514",
                                        "bullet": "https://www.amcharts.com/lib/images/faces/C02.png"
                                    }, {
                                        "name": "Patrick",
                                        "points": 45724,
                                        "color": "#DB4C3C",
                                        "bullet": "https://www.amcharts.com/lib/images/faces/D02.png"
                                    }, {
                                        "name": "Mark",
                                        "points": 13654,
                                        "color": "#DAF0FD",
                                        "bullet": "https://www.amcharts.com/lib/images/faces/E01.png"
                                    }],
                                    "valueAxes": [{
                                        "maximum": 80000,
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