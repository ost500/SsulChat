@extends('layouts.app')
@section('content')
    <section class="gl-page-header-wrapper" style="background: url('/images/featured-img.jpg')">
        <div class="container">
            <div class="row">
                <h1>{{ $user->name }}</h1>


            </div>
        </div>
    </section>

    <section class="gl-page-content-section">
        <div class="container">
            <div class="row">
                <div class="gl-blog-details-wrapper">


                    <!-- COMMENTS FORM -->
                    <div class="gl-comments-form-wrapper">
                        <h3 class="gl-blog-sec-title">개인 정보</h3>

                        <form action="#">
                            <fieldset>
                                <input type="text" name="gl-comment-name" id="gl-comment-name" placeholder="이름"
                                       value="{{ $user->name }}">
                                <input type="email" name="gl-comment-email" id="gl-comment-email" placeholder="이메일"
                                       value="{{ $user->email }}">

                            </fieldset>


                            <input type="submit" value="변경하기" class="gl-btn">
                        </form>
                    </div>
                    <!-- END -->

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
                        @foreach($myChattings as $chatting)
                            <div class="gl-comments">
                                <!-- USER IMG -->
                                <div class="gl-user-img">
                                    <img src="images/user-img.png" alt="User" class="gl-lazy">
                                </div>
                                <!-- END -->


                                <!-- TEXT -->
                                <div class="gl-comment-text">
                                    <div class="gl-username-date">
                                        <h3>David Neo</h3>
                                        <span class="gl-comments-date">23 March, 2016</span>
                                    </div>
                                    <p>{{ $chatting->message }}</p>
                                    <a href="#" class="gl-reply">Reply</a>
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