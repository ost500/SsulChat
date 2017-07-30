@extends('layouts.app')
@section('content')

    <!-- HERO IMAGE -->
    <section class="gl-hero-img-wrapper">
        <div class="container">
            <div class="row">
                <div class="gl-elements-content-wrapper">


                    <!-- DIRECTORY FORM -->
                    <div class="gl-directory-searchbar gl-bz-directory-searchbar">
                        <form action="#" id="gl-bz-directory-form">
                            <fieldset>
                                <input type="text" name="gl-business-keyword" id="gl-business-keyword"
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

@endsection