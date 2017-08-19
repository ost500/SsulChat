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
                                <h1 class="gl-sub-heading">페이지 만들기</h1>

                                <form class="gl-contact-form" method="POST" action="{{ route('create.page.post') }}">
                                    {{ csrf_field() }}
                                    <h3>페이지명</h3>
                                    <input type="text" name="name" id="gl-contact-email"
                                           placeholder="">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                    <input style="margin:40px;margin-left: auto;margin-right: auto;" type="submit"
                                           value="페이지 생성" class="gl-btn">
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