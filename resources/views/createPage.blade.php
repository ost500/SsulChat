@extends('layouts.app')
@section('content')
    <section class="gl-elements-shortcode-section">
        <div class="container">
            <div class="row">


                <!-- *****************
                Contact Form
                ***************** -->
                <div class="gl-element-type-wrapper">

                    <div class="gl-element-wrapper">
                        <div class="gl-row">
                            <div class="col-md-3 col-sm-3"></div>
                            <div style="margin-top:20px;" class="col-md-6 col-sm-6 col-xs-12">
                                <h1 class="gl-sub-heading">비밀번호 찾기</h1>

                                <form class="gl-contact-form" method="POST" action="{{ route('password.email') }}">
                                    {{ csrf_field() }}
                                    <h3>이메일</h3>
                                    <input type="email" name="email" id="gl-contact-email"
                                           placeholder="Email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                    <input style="margin:40px;margin-left: auto;margin-right: auto;" type="submit"
                                           value="리셋 링크 보내기" class="gl-btn">
                                </form>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>


                    </div>
                </div>
                <!-- Tags End -->

            </div>
        </div>
    </section>
@endsection