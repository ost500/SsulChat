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
                        <img src="{{ $best->user->profile_img }}" alt="User" class="gl-lazy">
                    </div>
                    <!-- END -->

                    <!-- TEXT -->
                    <div class="gl-comment-text">
                        <div class="gl-username-date">

                            <a href="{{ route('chattings', ['name' => $best->ssuls->first()->name]) }}">
                                <h3>{{ $best->user->name }}</h3>
                                <h3>{{ $best->ssuls->first()->name }}</h3>
                                <span class="gl-comments-date">{{ $best->created_at }}</span>
                            </a>

                        </div>
                        <a href="{{ route('chattings', ['name' => $best->ssuls->first()->name]) }}"><img
                                    src="{{ $best->picture }}"></a>
                        <p>{{ $best->content }} <i style="color: #fc4a52;" class="fa fa-heart"
                                                   aria-hidden="true"> {{ $best->likeCount }}</i></p>

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