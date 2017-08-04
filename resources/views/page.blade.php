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
    <section class="gl-page-header-wrapper">
        <div class="container">
            <div class="row">
                <h1>{{ $page->title }}</h1>
                {{--<p><i class="ion-ios-location-outline"></i>Highway Road 3, Lane 56, California, USA</p>--}}
                <span class="gl-item-rating"><i class="ion-ios-star"></i>{{ $page->ssuls_count }}</span>

                <div class="gl-page-head-btn-wrapper">
                    <a data-remodal-target="modal-share" class="gl-btn gl-icon-btn gl-share-btn">Share</a>
                    <a href="#" class="gl-btn gl-icon-btn"><i class="fa fa-heart-o"></i>Favourite</a>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE HEADER -->

    <!-- TAB NAV & META -->
    <section class="gl-tab-profile-meta-section">
        <div class="container">
            <div class="row">
                <div class="gl-tab-nav-wrapper col-md-8 col-sm-8 col-xs-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#overview" aria-controls="overview" role="tab"
                                                                  data-toggle="tab">Overview</a></li>
                        <li role="presentation"><a href="#similar-listing" aria-controls="similar-listing" role="tab"
                                                   data-toggle="tab">Similar Listing</a></li>
                    </ul>
                </div>

                <div class="gl-profile-meta-wrapper col-md-4 col-sm-4 col-xs-12">
                    <ul>
                        {{--<li><i class="fa fa-link"></i>domain.com</li>--}}
                        {{--<li><i class="fa fa-phone"></i>096 535 11</li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- TAB NAV & META END -->




    <!-- PAGE CONTETNT -->
    <section class="gl-page-content-section">

        <div class="container">

            <div class="row" id="chart">

                <div class="col-sm-6">
                    <div id="chartdiv"></div>
                </div>
                <div class="col-sm-6">
                    <div id="chartdiv2"></div>
                </div>
                <div class="gl-element-type-wrapper">

                    <h3>연관 검색어</h3>
                    <div class="gl-element-wrapper gl-elements-page" style="margin-bottom: 130px;">
                        @foreach($morphs as $morph)
                            <a href="#" class="gl-tag-btn gl-design">{{ $morph->morph }}
                                {{ $morph->morph_count }}</a>
                        @endforeach
                    </div>
                </div>

                <!-- SIDEBAR -->
                <div class="gl-sidebar gl-page-sidebar col-md-4 col-sm-4 col-xs-12">
                    <div class="gl-sidebar-widget gl-category-widget">
                        <h3 class="gl-sidebar-title">채팅방</h3>

                        <ul>
                            @foreach($page->ssuls as $ssul)
                                <li><a href="{{ route('chattings', ['id' => $ssul->id]) }}">{{ $ssul->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>


                </div>
                <!-- SIDEBAR END -->
                <!-- PAGE CONTENT DETAILS -->
                <div class="gl-page-content tab-content col-md-8 col-sm-8 col-xs-12">

                    <!-- GALLERY TAB -->
                    <div role="tabpanel" class="tab-pane fade in active" id="overview">
                        <!-- GALLERY -->
                        <div class="gl-profile-gallery">
                            <ul class="gl-gallery">


                                <!-- FEATURED ITEMS -->
                                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                    <div class="gl-feat-items-img-wrapper">
                                        <img src="/images/featured-listing-3.jpg" alt="Featured Listing"
                                             class="gl-lazy">
                                    </div>

                                    <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                        <h3>
                                            <a href="#">Cafe Hapus</a>
                                        </h3>
                                        <div class="gl-item-location">
                                            <i class="ion-ios-location-outline"></i>
                                            <span>Road 3, West Portland, USA</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END -->

                                <!-- FEATURED ITEMS -->
                                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                    <div class="gl-feat-items-img-wrapper">
                                        <img src="/images/featured-listing-3.jpg" alt="Featured Listing"
                                             class="gl-lazy">
                                    </div>

                                    <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                        <h3>
                                            <a href="#">Cafe Hapus</a>
                                        </h3>
                                        <div class="gl-item-location">
                                            <i class="ion-ios-location-outline"></i>
                                            <span>Road 3, West Portland, USA</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END -->
                            </ul>
                        </div>
                        <!-- END -->


                        <!-- REVIEWS / COMMENT DETAILS -->
                        <div class="gl-review-details appear fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
                            <h3 class="gl-content-title">5 Reviews</h3>
                            <!-- Reviews -->
                            <div class="gl-reviews">
                                <!-- USER IMG -->
                                <div class="gl-user-img">
                                    <img src="/images/author-img.jpg" alt="User" class="gl-lazy">
                                </div>
                                <!-- END -->

                                <!-- TEXT -->
                                <div class="gl-review-text">
                                    <h3>David Neo</h3>
                                    <p>On the other hand, we denounce with righteous indignation and dislike men who
                                        beguiled and demoralized by the of pleasure</p>
                                    <span class="gl-item-rating"><i class="ion-ios-star"></i>4.5</span>
                                </div>
                                <!-- END -->
                            </div>
                            <!-- END -->
                        </div>
                        <!-- END -->

                    </div>
                    <!-- GALLERY TAB END -->

                    <!-- PROTFOLIO TAB -->
                    <div role="tabpanel" class="tab-pane fade" id="similar-listing">
                        <!-- WRAPPER -->
                        <div class="gl-similar-listing-wrapper">

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/featured-listing-1.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>

                                    <h3>
                                        <a href="#">Office Rent</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/featured-listing-2.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>

                                    <h3>
                                        <a href="#">Lake Heaven</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/featured-listing-3.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                    <h3>
                                        <a href="#">Cafe Hapus</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/business-img-1.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                    <h3>
                                        <a href="#">Lake Heaven</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/business-img-4.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                    <h3>
                                        <a href="#">Office Rent</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/business-img-10.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                    <h3>
                                        <a href="#">Cafe Hapus</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/business-img-3.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                    <h3>
                                        <a href="#">Lake Heaven</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- FEATURED ITEMS -->
                            <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                                <div class="gl-feat-items-img-wrapper">
                                    <img src="/images/business-img-7.jpg" alt="Featured Listing" class="gl-lazy">
                                </div>

                                <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                                    <h3>
                                        <a href="#">Office Rent</a>
                                    </h3>
                                    <div class="gl-item-location">
                                        <i class="ion-ios-location-outline"></i>
                                        <span>Road 3, West Portland, USA</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->

                        </div>
                        <!-- END -->
                    </div>
                    <!-- PROTFOLIO TAB END -->
                </div>
                <!-- PAGE CONTENT DETAILS END -->


            </div>
        </div>
    </section>
    <!-- PAGE CONTETNT END -->



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