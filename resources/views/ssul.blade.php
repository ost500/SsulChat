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
        <h1>썰 만들기</h1>
        <span><a href="{{ route('main') }}"><img src="images/profile_X.png" alt="닫기"></a></span>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('ssul.create') }}">
        {{ csrf_field() }}
        <div class="profile_form_wrap">
            <div class="profile_formL">
                <div class="login_logo">
                    <img src="images/main_logo02.png" alt="썰챗로고" class="login_logo_img">
                </div>
                <fieldset>
                    <div id="box">
                        <table summary="썰 만들기">
                            <caption style="display:none;">썰 만들기</caption>

                                <tr>
                                    <th scope="row" id="form01-1"><label for="form01">썰 제목</label></th>
                                    <td headers="form01-1"><input type="text" name="name" id="form01" class="textfield"
                                                                  style="outline:none" placeholder="썰 제목" required value="{{ old('name') }}"/>
                                    </td>
                                    <td>{{ $errors->first('name') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" id="form02-1"><label for="form02">세력 이름1</label></th>
                                    <td headers="form02-1"><input type="text" name="team1" id="form02" class="textfield"
                                                                  style="outline:none" placeholder="" value="{{ old('team1') }}"/></td>
                                    <td>{{ $errors->first('team1') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" id="form02-1"><label for="form02">세력 이름2</label></th>
                                    <td headers="form02-1"><input type="text" name="team2" id="form03" class="textfield"
                                                                  style="outline:none" placeholder="" value="{{ old('team2') }}"/></td>
                                    <td>{{ $errors->first('team2') }}</td>
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
                {{--<span id="form_btn_n"><input type="submit" alt="Cancel" value="Cancel"/></span>--}}
                <span id="form_btn_o"><input type="submit" alt="OK" value="OK"/></span>
            </div>
        </div>
    </form>
</div>
</body>
</html>
