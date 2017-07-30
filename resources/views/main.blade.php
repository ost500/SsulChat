@extends('layouts.app')
@section('content')

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
        <div class="container">
            <div class="row">
                <!-- SECTION HEADINGS -->
                <div class="gl-section-headings">
                    <h1>위키 페이지</h1>
                    <p>오늘의 페이지</p>
                </div>
                <!-- END -->

                <!-- WRAPPER -->
                <div class="gl-featured-listing-wrapper">
                    @foreach($pages as $page)
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
                    @endforeach


                </div>
                <!-- MORE BTN -->
                <div class="gl-more-btn-wrapper">
                    <a href="{{ route('pageList') }}" class="gl-more-btn gl-btn">더보기</a>
                </div>
                <!-- END -->
            </div>
        </div>

    </section>

    <!-- FEATURED LISTINGS -->
    <section class="gl-feat-listing-section gl-section-wrapper">
        <div class="container">
            <div class="row">
                <!-- SECTION HEADINGS -->
                <div class="gl-section-headings">
                    <h1>위키 채팅</h1>
                    <p>오늘의 핫이슈</p>
                </div>
                <!-- END -->

                <!-- WRAPPER -->
                <div class="gl-featured-listing-wrapper">
                @foreach($channels as $num => $channel)

                    <!-- FEATURED ITEMS -->
                        <div class="gl-featured-items col-md-2 col-sm-2 col-xs-6 appear fadeIn" data-wow-duration="1s"
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
                    @endforeach


                </div>
                <!-- END -->

                <!-- MORE BTN -->
                <div class="gl-more-btn-wrapper">
                    <a href="{{ route('chattingList') }}" class="gl-more-btn gl-btn">더보기</a>
                </div>
                <!-- END -->
            </div>
        </div>
    </section>
    <!-- FEATURED LISTINGS END -->

@endsection