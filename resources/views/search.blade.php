@extends('layouts.app')
@section('content')

    <!-- HERO IMAGE -->
    <section class="gl-hero-img-wrapper">
        <div class="container">
            <div class="row">
                <div class="gl-elements-content-wrapper">


                    <!-- DIRECTORY FORM -->
                    <div class="gl-directory-searchbar gl-bz-directory-searchbar">
                        <form action="{{ route('search') }}" id="gl-bz-directory-form">
                            <fieldset>
                                <input type="text" name="question" id="gl-business-keyword"
                                       class="gl-directory-input" placeholder="키워드" value="{{ $question }}">


                            </fieldset>

                            <button type="submit" class="gl-icon-btn"><i class="fa fa-search"></i> 검색</button>
                        </form>
                    </div>
                    <!-- END -->

                </div>
            </div>
        </div>
    </section>



    @if($pages->count())
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
                    <div class="gl-more-btn-wrapper">
                        {{ $pages->render() }}
                    </div>


                </div>
            </div>

        </section>
    @else
        <section class="gl-feat-listing-section gl-section-wrapper">
            <div class="container">
                <div class="row">
                    <!-- SECTION HEADINGS -->
                    <div class="gl-section-headings">

                        <p>페이지 검색 결과가 없습니다</p>
                    </div>
                    <!-- END -->


                </div>
            </div>

        </section>
    @endif

    @if($chattings->count())
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
                    @foreach($chattings as $num => $channel)

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
                    @endforeach



                    </div>
                    <!-- END -->

                    <!-- MORE BTN -->
                    <div class="gl-more-btn-wrapper">

                        {{ $chattings->render() }}
                        {{--<a href="#" class="gl-more-btn gl-btn">More</a>--}}
                    </div>
                    <!-- END -->
                </div>
            </div>
        </section>
        <!-- FEATURED LISTINGS END -->
    @else
        <!-- FEATURED LISTINGS -->
        <section class="gl-feat-listing-section gl-section-wrapper">
            <div class="container">
                <div class="row">
                    <!-- SECTION HEADINGS -->
                    <div class="gl-section-headings">
                        <p>채팅방 검색 결과가 없습니다</p>
                    </div>
                    <!-- END -->

                @if($addNew)

                    <!-- FEATURED ITEMS -->
                        <div class="gl-featured-items col-md-2 col-sm-2 col-xs-6 appear fadeIn"
                             data-wow-duration="1s"
                             data-wow-delay=".3s">
                            <div class="gl-feat-items-img-wrapper">

                                <picture>
                                    <source media="(min-width: 768px)" srcset="/images/post-img-1.jpg">
                                    <img alt="{{ $question }}" srcset="/images/post-img-1.jpg">
                                </picture>
                            </div>

                            <div class="gl-feat-item-details">
                                    <span class="gl-item-rating">
                                      <i class="ion-android-star-outline"></i>
                                        0
                                    </span>
                                <h3>
                                    <a href="{{ route('chattings',['name'=>$question]) }}">{{ $question }} 새로 만들기</a>
                                </h3>

                            </div>
                        </div>
                        <!-- END -->
                    @endif

                </div>
            </div>
        </section>
        <!-- FEATURED LISTINGS END -->
    @endif

@endsection