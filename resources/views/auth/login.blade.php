<!doctype html>
<html lang="ko" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">

    <title>Ssulchat</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/login_mobile.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<div id="wrap">
    <div class="header_profile">
        <h1>LOGIN</h1>
        <span><a href="#"><img src="images/profile_X.png" alt="닫기"></a></span>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="profile_form_wrap">
            <div class="profile_formL">
                <div class="login_logo" >
                    <img src="images/main_logo02.png" alt="썰챗로고">
                </div>
                <fieldset>
                    <div id="box">
                        <table summary="로그인">
                            <caption style="display:none;">로그인</caption>
                            <tr>
                                <th scope="row" id="form02-1"><label for="form02">이메일주소</label></th>
                                <td headers="form02-1"><input type="text" name="email" id="form02" class="textfield"
                                                              style="outline:none" placeholder="E-MAIL"/></td>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row" id="form02-1"><label for="form02">비밀번호</label></th>
                                <td headers="form02-1"><input type="password" name="password" id="form03"
                                                              class="textfield" style="outline:none"
                                                              placeholder="PASSWORD"/></td>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </tr>
                            <!--												<tr>
                                                        <th scope="row" id="form03-1"><label for="form03">What I do</label></th>
                                                        <td headers="form03-1"><input type="text" name="textfield" id="form03" class="textfield" style="outline:none" placeholder="What I do" /></td>
                                                        <td class="td_txt">Let people know what you do at OP.GG.</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" id="form04-1"><label for="form04">Status</label></th>
                                                        <td headers="form04-1" class="form04-1"><span class="smileI"></span><input type="text" name="textfield" id="form04" class="textfield" style="outline:none" placeholder="What's your status?" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" id="form05-1"><label for="form05">Phone number</label></th>
                                                        <td headers="form05-1"><input type="text" name="textfield" id="form05" class="textfield" style="outline:none" placeholder="(123) 555-5555" /></td>
                                                        <td class="td_txt">Enter a phone number.</td>
                                                    </tr>
                                                    <tr id="select_box">
                                                        <th scope="row" id="form06-1"><label for="form06">Time Zone</label></th>
                                                        <td headers="form06-1" id="select_box">
                                                        <select name="form06" id="form06" class="form06" style="outline:none" >
                                                         <option selected="selected">Time Zone</option>
                                                         <option>(UTC+09:00) Osaka, Sapporo, Tokyo</option>
                                                         <option>(UTC+09:00) Osaka, Sapporo, Tokyo</option>
                                                         </select>
                                                        </td>
                                                        <td class="td_txt">Your current time zone. Used to send summary and notiification emails, for times in your activity feeds, and for reminders.</td>
                                                    </tr>
                            -->
                        </table>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>아이디 저장
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="profile_form_btn">
            <div>
                <span id="form_btn_o"><input type="submit" alt="OK" value="OK"/></span>
                <span id="form_btn_o"><input class="facebook_login_button"  v-on:click="facebookLogin" alt="OK" value="facebook"/></span>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="http://jsgetip.appspot.com"></script>
<script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>


<script>

    var chatting_app = new Vue({
        el: '#wrap',
        data: {},
        beforeCreate: function () {

        },

        methods: {

            facebookLogin: function () {
                window.location = "{{ route('facebookLogin') }}";
            }

        }
    })


</script>

</body>
</html>
