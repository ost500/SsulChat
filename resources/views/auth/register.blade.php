<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">

    <title>SsulChat</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/register_mobile.css">

</head>
<body>
<div id="wrap">
    <div class="header_profile">
        <h1>가입하기</h1>
        <span><a href="#"><img src="images/profile_X.png" alt="닫기"></a></span>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="profile_form_wrap">
            <div class="profile_formL">
                <fieldset >
                    <div id="box">
                        <table summary="프로필 수정하기" >
                            <caption style="display:none;">프로필 수정하기</caption>
                            <tr>
                                <th scope="row" id="form01-1"><label for="form01">닉네임</label></th>
                                <td headers="form01-1"><input type="text" name="name" id="form01" class="textfield" style="outline:none" placeholder="NICKNAME" required/></td>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row" id="form02-1"><label for="form02">이메일주소</label></th>
                                <td headers="form02-1"><input type="text" name="email" id="form02" class="textfield" style="outline:none" placeholder="E-MAIL" required/></td>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row" id="form02-1"><label for="form02">비밀번호</label></th>
                                <td headers="form02-1"><input type="password" name="password" id="form03" class="textfield" style="outline:none" placeholder="PASSWORD" required/></td>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row" id="form02-1"><label for="form02">비밀번호 확인</label></th>
                                <td headers="form02-1"><input type="password" name="password_confirmation" id="form04" class="textfield" style="outline:none" placeholder="CHECK YOUR PASSWORD" required/></td>
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
                </fieldset>
            </div>
        </div>

        <div class="profile_form_btn">
            <div>
                <span id="form_btn_n"><input type="submit" alt="Cancel" value="Cancel" /></span>
                <span id="form_btn_o"><input type="submit" alt="OK" value="OK" /></span>
            </div>
        </div>
    </form>
</div>
</body>
</html>
