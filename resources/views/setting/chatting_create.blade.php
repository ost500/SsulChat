@extends('setting._layout')
@section('content')

    <section class="up-redq-frontend--section up-redq-form-submission-page ">
        <div class="up-redq-inner-wrapper">
            <!-- ++++++++++++++++++++++++++++++
            ==> LEFTSIDE NAVIGATION
            +++++++++++++++++++++++++++++++ -->
            <nav class="up-redq-leftside-nav">
                <div class="up-redq-logo">
                    <a href="#">
                        <img src="images/logo.png" alt="UserpLace">
                    </a>
                </div>

                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="mic-icon-home"></i>
                            홈
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pages.setting', ['id'=>$page->id]) }}">
                            <i class="mic-icon-settings"></i>
                            설정
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- +++++++ LEFTSIDE NAVIGATION END +++++++ -->

            <!-- ++++++++++++++++++++++++++++++
            ==> MAIN CONTENT
            ++++++++++++++++++++++++++++++ -->
            <div class="up-redq-contents-wrapper">

                <!-- ********** HEADER ********** -->
                <header class="up-redq-header-wrapper">
                    <button type="button" class="toggle-nav">
                        <span class="up-nav-bar"></span>
                        <span class="up-nav-bar"></span>
                        <span class="up-nav-bar"></span>
                    </button>

                    <ul class="up-redq-header-content">
                        <li class="up-redq-inbox up-dropdown--btn">
                            <span class="up-redq-inbox-title">Inbox</span>
                            <span class="up-redq-icon-holder">
                    <i class="mic-icon-comment"></i>
                    <span class="up-redq-msg-count">3</span>
                  </span>

                            <ul class="up-redq--dropdown">
                                <li>
                                    <a href="#">
                          <span class="up-user-img">
                            <img src="images/user-img.png" alt="user">
                            <span class="up-user-status up-online"></span>
                          </span>

                                        <span class="up-user-info">
                            <h3>Roman<span class="up-msg-num">(2)</span></h3>
                            <span class="up-msg-excerpt">Happy Birthday</span>
                            <span class="up-msg-time">3.30 pm</span>
                          </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                          <span class="up-user-img">
                            <img src="images/user-img.png" alt="user">
                            <span class="up-user-status up-away"></span>
                          </span>

                                        <span class="up-user-info">
                            <h3>Roman<span class="up-msg-num">(2)</span></h3>
                            <span class="up-msg-excerpt">Happy Birthday</span>
                            <span class="up-msg-time">3.30 pm</span>
                          </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                          <span class="up-user-img">
                            <img src="images/user-img.png" alt="user">
                            <span class="up-user-status up-away"></span>
                          </span>

                                        <span class="up-user-info">
                            <h3>Roman<span class="up-msg-num">(2)</span></h3>
                            <span class="up-msg-excerpt">Happy Birthday</span>
                            <span class="up-msg-time">3.30 pm</span>
                          </span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="up-redq-usericon up-dropdown--btn">
                            <span class="up-redq-username">James Honda</span>
                            <span class="up-redq-userimg-wrapper">
                    <img src="images/user-img.png" alt="User">
                  </span>

                            <ul class="up-redq--dropdown">
                                <li>
                                    <a href="#">
                                        <i class="mic-icon-badge"></i>
                                        Bookmark
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="mic-icon-file"></i>
                                        Invoice
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="mic-icon-cloud"></i>
                                        Subscribtion
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="mic-icon-settings"></i>
                                        Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="mic-icon-logout"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </header>
                <!-- ********** HEADER END ********** -->

                <!-- MAIN CONTENT -->
                <div class="up-redq-main-content">
                    <!-- SEARCH & SETTINGS FIELD -->
                    <div class="up-redq-item-list-wrapper" id="chatting_delete">
                        <!-- SEARCH -->
                        <div class="up-redq-search-box-wrapper">
                            <form action="#">
                                <input type="search" class="up-redq-search-input" name="up-redq-search"
                                       id="up-redq-search" placeholder="Search job">
                                <!-- <button type="submit"><i class="mic-icon-search"></i></button> -->
                            </form>
                        </div>
                        <!-- SEARCH END -->

                        <div class="up-redq-item-list">
                        @foreach($page->ssuls as $ssul)
                            <!-- ITEM -->
                                <div class="up-redq-single-form-item publish-post">
                                    <a href="#">
                                        <h3>{{ $ssul->name }}</h3>
                                        <p>{{ $ssul->created_at }}</p>

                                    </a>
                                    <button v-on:click="deleteSsul({{$ssul->id}})" class="delete">삭제</button>

                                </div>
                                <!-- ITEM END -->
                            @endforeach
                        </div>
                    </div>
                    <!-- MESSAGE WRAPPER END -->

                    <!-- CONTROLS -->
                    <div class="up-redq-post-subbmission-wrapper">

                        <form action="{{ route('pages.setting.chatting.create', ['id' => $page->id]) }}" method="post">
                        {!! csrf_field() !!}

                        <!-- FRONTEND SUBMISSION FORM -->
                            <div class="up-redq-chatbox-form-wrapper">
                                <!-- Form -->
                                <div class="up-redq-form-wrapper">

                                    <!-- post title -->
                                    @if(session()->get('create_chatting'))
                                        <div class="up-redq-fieldset up-redq-invalid-input">
                                            @else
                                                <div class="up-redq-fieldset">
                                                    @endif
                                                    <h3 class="up-redq-fieldset-label">채팅방</h3>
                                                    <input type="text" class="up-redq-inputbox" name="create_chatting">

                                                    @if (session()->get('create_chatting'))
                                                        <span class="up-redq-err-field">
                                                {{ session()->get('create_chatting') }}
                                            </span>

                                                    @endif
                                                </div>
                                                <!-- end -->


                                        </div>
                                        <!-- Form end -->
                                </div>
                                <!-- FRONTEND SUBMISSION FORM END -->

                                <!-- FLOATING BTN (PREVIEW & NEXT) -->
                                <div class="up-redq-floating-fixed-wrapper">

                                    <button type="submit" class="up-redq-option-btn">입력하기</button>
                                </div>
                                <!-- FLOATING BTN (PREVIEW & NEXT) END -->
                            </div>
                        </form>
                    </div>
                    <!-- SEARCH & SETTINGS FIELD END -->
                </div>
                <!-- MAIN CONTENT END -->
            </div>
            <!-- +++++++ MAIN CONTENT END +++++++ -->
        </div>
    </section>


    <script>

        var main = new Vue({
            el: '#chatting_delete',
            data: {},
            created: function () {

            },
            methods: {
                deleteSsul: function (ssul_id) {
                    if (confirm('식제하시겠습니까?')) {
                        axios.delete('{{ route('pages.setting.chatting.delete',['id' => $page->id]) }}',
                            {params: {ssul_id: ssul_id}}).then(function () {
                            location.reload();
                        });
                    }
                }
            }
        })
    </script>

@endsection