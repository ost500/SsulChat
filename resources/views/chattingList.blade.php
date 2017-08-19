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
                                       class="gl-directory-input" placeholder="키워드">


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

            <!-- SECTION HEADINGS -->
            <div class="gl-section-headings">
                <h1>배틀채팅 채팅방</h1>
                <p>오늘의 핫이슈</p>
            </div>
            <!-- END -->

            <!-- WRAPPER -->
            <div class="gl-featured-listing-wrapper">
                @foreach($chattings as $num => $channel)
                    @if(($num + 1) %6 == 0)
                        <div class="row">
                        @endif
                        <!-- FEATURED ITEMS -->
                            <div onclick="location.href='{{ route('chattings',['name'=>$channel->name]) }}'"
                                 class="gl-featured-items col-md-2 col-sm-2 col-xs-6 appear fadeIn"
                                 data-wow-duration="1s"
                                 data-wow-delay=".3s">
                                <div class="gl-feat-items-img-wrapper">

                                    <picture>
                                        <source media="(min-width: 768px)" src="{{ $channel->picture }}">
                                        <img alt="{{ $channel->name }}" src="{{ $channel->picture }}">
                                    </picture>
                                </div>

                                <div class="gl-feat-item-details">
                            <span class="gl-item-rating">
                              <i class="fa fa-user" aria-hidden="true">
                                  </i>
                                @if(isset($channel->loginMembersCount)){{ $channel->loginMembersCount }}@endif



                            </span>
                                    <h3>
                                        <a href="{{ route('chattings',['name'=>$channel->name]) }}">{{ $channel->name }}</a>
                                    </h3>

                                </div>
                            </div>
                            <!-- END -->
                            @if(($num + 1) %6 == 0)
                        </div>
                    @endif
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
    </section>
    <!-- FEATURED LISTINGS END -->
    @include('belowBest')

@endsection