@extends('layouts.app')
@section('content')
    <section class="gl-page-header-wrapper" style="background: url('/images/featured-img.jpg')">
        <div class="container">
            <div class="row">
                <img src="{{ $user->profile_img }}">
                <h1>{{ $user->name }}</h1>


            </div>
        </div>
    </section>

    <section class="gl-page-content-section">
        <div class="container">
            <div class="row">

                <div class="gl-sidebar-widget gl-author-widget">
                    <div class="gl-author-img-wrapper">
                        <img src="{{ $user->profile_img }}" alt="Author" class="gl-lazy">
                    </div>

                    <div class="gl-author-details">
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>
                        <h4>사진 변경</h4>

                        <div class="row">
                            <form action="{{ route('mypage_picture.post') }}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <input type="file" name="picture" class="gl-btn">
                                </div>
                                <div class="col-sm-3">
                                    <input type="submit" value="변경하기" class="gl-btn">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="gl-sidebar-widget gl-sidebar-contact-form">
                    <h3 class="gl-sidebar-title">이름 변경</h3>

                    <form action="{{ route('mypage.post') }}" method="post">
                        {!! csrf_field() !!}
                        <input type="text" name="name" id="gl-name" placeholder="이름"
                               value="{{ $user->name }}">
                        <input type="submit" value="변경하기" class="gl-btn">
                    </form>
                </div>


            </div>
        </div>
    </section>

    <section class="gl-page-content-section">
        <div class="container">
            <div class="row">
                <div class="gl-blog-details-wrapper">


                    <!-- COMMENTS -->
                    <div class="gl-post-comments-wrapper">
                        <h3 class="gl-blog-sec-title">채팅</h3>
                        <!-- Reviews -->
                        @foreach($myChattings->chattings as $chatting)
                            <div class="gl-comments">
                                <!-- USER IMG -->
                                <div class="gl-user-img">
                                    <img src="{{ $user->profile_img }}" alt="User" class="gl-lazy">
                                </div>
                                <!-- END -->


                                <!-- TEXT -->
                                <div class="gl-comment-text">
                                    <div class="gl-username-date">
                                        <a href="{{ route('chattings', ['name' => $chatting->ssuls->first()->name]) }}">
                                            <h3>{{ $user->name }}</h3>
                                            <h3>{{ $chatting->ssuls->first()->name }}</h3>
                                            <span class="gl-comments-date">{{ $chatting->created_at }}</span>
                                        </a>
                                    </div>


                                    <p>{{ $chatting->content }}</p>
                                    {{--<a href="#" class="gl-reply">Reply</a>--}}
                                </div>
                                <!-- END -->
                            </div>
                            <!-- END -->
                        @endforeach
                    </div>
                    <!-- END -->


                </div>
            </div>
        </div>
    </section>

@endsection