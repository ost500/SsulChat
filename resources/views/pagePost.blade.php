@extends('layouts.app')
@section('content')


    <!-- FEATURED IMAGE -->
    <section class="gl-featured-image-wrapper">
        <picture>
            <source media="(min-width: 768px)" src="{{ $pagePost->page->background_picture }}">
            <img alt="Featured Image" src="{{ $pagePost->page->background_picture }}">
        </picture>
    </section>
    <!-- FEATURED IMAGE END -->

    <!-- PAGE CONTETNT -->
    <section class="gl-page-content-section">
        <div class="container">
            <div class="row">
                <div class="gl-blog-details-wrapper">

                    <!-- HEADINGS -->
                    <div class="gl-blog-heading-metas">
                        <h1 class="gl-blog-titles">{{ $pagePost->message }}</h1>
                        <ul>
                            <li class="gl-blog-post-date">{{ $pagePost->created_at }}</li>
                            <li class="gl-author"><a href="#">admin</a></li>
                            {{--<li class="gl-comments"><a href="#">3 Comments</a></li>--}}
                        </ul>
                    </div>
                    <!-- END -->


                        <div class="gl-blogpost-images">
                            @foreach($pagePost->pagePostPictures as $picture)
                                <div style="text-align: center" class="gl-post-img-wrapper">
                                    <img src="{{ $picture->photo }}" alt="Post Image" class="gl-lazy">
                                </div>
                            @endforeach

                        </div>

                    <!-- POST METAS -->
                    <div class="gl-post-metas">
                        {{--<div class="gl-tag-wrapper">--}}
                        {{--<a href="#" class="gl-tags">design</a>--}}
                        {{--<a href="#" class="gl-tags">travel</a>--}}
                        {{--<a href="#" class="gl-tags">food</a>--}}
                        {{--</div>--}}

                        <a data-remodal-target="modal-share" class="gl-btn gl-share-btn">공유하기</a>
                    </div>
                    <!-- END -->


                </div>
            </div>
        </div>
    </section>
    <!-- PAGE CONTETNT END -->



@endsection