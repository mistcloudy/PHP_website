<html>
<head>
    <title> 설문조사 </title>
    <link rel = "stylesheet" type = "text/css" href="../css/survey.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <meta charset="utf-8">
    <script>
        function update()
        {
            var vote;
            var length = document.survey_form.composer.length;

            for(var i=0; i<length; i++)
            {
                if(document.survey_form.composer[i].checked==true)
                {
                    vote=document.survey_form.composer[i].value;
                    break;
                }
            }

            if(i==length)
            {
                alert("문항을  선택하세요.");
                return;
            }
            window.open("update.php?composer="+vote, "", "left=200, top=200, width=230, height=250, status=no, scrollbars=no ");
            window.close();
        }
        function result()
        {
            window.open("result.php", "", "left=200, top=200, width=230, height=250, status=no, scrollbars=no ");
            window.close();
        }

        function setCookie( name, value, expiredays )
        {
            var todayDate = new Date();
            todayDate.setDate( todayDate.getDate() + expiredays );
            document.cookie = name + '=' + escape( value ) + '; path=/; expires=' + todayDate.toGMTString() + ';'
        }

        //쿠키 불러오기
        function getCookie(name)
        {
            var obj = name + "=";
            var x = 0;
            while ( x <= document.cookie.length )
            {
                var y = (x+obj.length);
                if ( document.cookie.substring( x, y ) == obj )
                {
                    if ((endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
                        endOfCookie = document.cookie.length;
                    return unescape( document.cookie.substring( y, endOfCookie ) );
                }
                x = document.cookie.indexOf( " ", x ) + 1;
                if ( x == 0 )
                    break;
            }
            return "";
        }

        //닫기 버튼 클릭시
        function closeWin(key)
        {
            if($("#todaycloseyn").prop("checked"))
            {
                setCookie('divpop'+key, 'Y' , 1 );
            }
            $("#divpop"+key+"").hide();
        }

        $(function(){

            if(getCookie("divpop1") !="Y"){
                $("#divpop1").show();
            }

        });
    </script>
</head>
<body>
<form name="survey_form" method="post">
    <div id="divpop1" class="divpop">
    <table border="0" cellspacing="0" cellpadding="0" width="200" align="center">
        <input type="hidden" name="kkk" value="100">
        <tr height="40">
            <td><img src="../img/bbs_poll.gif"</td>
        </tr>
        <tr height="1" bgcolor="#cccccc"><td></td></tr>
        <tr height="7"><td></td></tr>
        <tr><td><b> ### 가장 가고 싶은 일본 여행지는? ###</b></td></tr>
        <tr><td><input type="radio" name="composer" value="ans1"> 1. 도쿄</td></tr>
        <tr height="5"><td></td></tr>
        <tr><td><input type="radio" name="composer" value="ans2"> 2. 오사카</td></tr>
        <tr height="5"><td></td></tr>
        <tr><td><input type="radio" name="composer" value="ans3"> 3. 오키나와</td></tr>
        <tr height="5"><td></td></tr>
        <tr><td><input type="radio" name="composer" value="ans4"> 4. 홋카이도</td></tr>
        <tr height="7"><td></td></tr>
        <tr height="1" bgcolor="#cccccc"><td></td></tr>
        <tr>
        <tr height="7"><td></td></tr>
        <tr>
            <td align="middle"><img src="../img/b_vote.gif" border="0" style="cursor:hand" onclick="update()" >
                <img src="../img/b_result.gif" border="0" style="cursor:hand" onclick="result()" ></td></tr>
    </table>
        <div class="button_area">
            <input type='checkbox' name='chkbox' id='todaycloseyn' value='Y'>오늘 하루 이 창을 열지 않음
            <a href='#' onclick="javascript:closeWin(1);"><B>[닫기]</B></a>
        </div>
    </div>
</form>
</body>
</html>
