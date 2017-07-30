@extends('layouts.app')
@section('content')
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
            <div class="row">
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
            </div>
        </div>
    </section>
    <!-- PAGE CONTETNT END -->

@endsection