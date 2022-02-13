<?php

require_once ("../lib/MYDB.php");
$pdo = db_connect();

try{
    $sql = "select * from test.survey";
    $stmh = $pdo->query($sql);

    $row = $stmh->fetch(PDO::FETCH_ASSOC);

    $total = $row["ans1"] + $row["ans2"] + $row["ans3"] + $row["ans4"];
    $ans1_percent = $row["ans1"]/$total *100;
    $ans2_percent = $row["ans2"]/$total *100;
    $ans3_percent = $row["ans3"]/$total *100;
    $ans4_percent = $row["ans4"]/$total *100;
    $ans1_percent = floor($ans1_percent);
    $ans2_percent = floor($ans2_percent);
    $ans3_percent = floor($ans3_percent);
    $ans4_percent = floor($ans4_percent);
    ?>
<html>
<head>
<title> 설문조사 </title>
<link rel = "stylesheet" type = "text/css" href="../css/survey.css">
<meta charset="utf-8">

<body>
    <table width=250 height =250  border=0 cellspacing=0 cellpadding=0>
        <tr>
            <td width=180 height=1 colspan=5 bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td width=1 height =35 bgcolor=#ffffff></td>
            <td width=9 bgcolor=#ffffff></td>
            <td width=150 align=center bgcolor=#ffffff><b>
                    총 투표수 : <?php print $total ?> &nbsp;명 </b></td>
            <td width=9 bgcolor=#ffffff></td>
            <td width=1 bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=29 bgcolor=#ffffff></td>
            <td></td>
            <td valign=middle><b> ### 가장 가고 싶은 일본 여행지는 어디입니까? ### </b></td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=20 bgcolor=#ffffff></td>
            <td></td>
            <td> 도쿄 (<b><?php print $ans1_percent ?></b> %)
                <font color=purple><b><?php print $row["ans1"] ?></b></font> 명</td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=3 bgcolor=#ffffff></td>
            <td></td>
            <td>
                <table width=100 height =3  border=0 cellspacing=0 cellpadding=0>
                    <tr>
                        <?php
                        $rest = 100 - $ans1_percent;
                        print "
                        <td width='$ans1_percent%' bgcolor=purple></td>
                        <td width='$rest%' bgcolor=#dddddd height=5></td>
                        ";
                        ?>
                    </tr>
                </table>
            </td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=20 bgcolor=#ffffff></td>
            <td></td>
            <td> 오사카 (<b><?php print $ans2_percent ?></b> %)
                <font color=blue><b><?php print $row["ans2"] ?></b></font> 명</td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=3 bgcolor=#ffffff></td>
            <td></td>
            <td>
                <table width=100 height =3  border=0 cellspacing=0 cellpadding=0>
                    <tr>
                        <?php
                        $rest = 100 - $ans2_percent;
                        print "
                        <td width='$ans2_percent%' bgcolor=blue></td>
                        <td width='$rest%' bgcolor=#dddddd height=5></td>
                        ";
                        ?>
                    </tr>
                </table>
            </td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=20 bgcolor=#ffffff></td>
            <td></td>
            <td> 오키나와 (<b><?php print $ans3_percent ?></b> %)
                <font color=green><b><?php print $row["ans3"] ?></b></font> 명</td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=3 bgcolor=#ffffff></td>
            <td></td>
            <td>
                <table width=100 height =3  border=0 cellspacing=0 cellpadding=0>
                    <tr>
                        <?php
                        $rest = 100 - $ans3_percent;
                        print "
                        <td width='$ans3_percent%' bgcolor=green></td>
                        <td width='$rest%' bgcolor=#dddddd height=5></td>
                        ";
                        ?>
                    </tr>
                </table>
            </td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=20 bgcolor=#ffffff></td>
            <td></td>
            <td> 홋카이도 (<b><?php print $ans4_percent ?></b> %)
                <font color=skyblue><b><?php print $row["ans4"] ?></b></font> 명</td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=3 bgcolor=#ffffff></td>
            <td></td>
            <td>
                <table width=100 height =3  border=0 cellspacing=0 cellpadding=0>
                    <tr>
                        <?php
                        $rest = 100 - $ans4_percent;
                        print "
                        <td width='$ans4_percent%' bgcolor=skyblue></td>
                        <td width='$rest%' bgcolor=#dddddd height=5></td>
                        ";
                        ?>
                    </tr>
                </table>
            </td>
            <td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=40 bgcolor=#ffffff></td>
            <td></td>
            <td align=center valign=middle>
                <input type=image style="cursor: hand" src="../img/close.gif" border=0 onfocus=this.blur() onclick="window.close()"></td>
<td></td>
            <td  bgcolor=#ffffff></td>
        </tr>
        <tr>
            <td height=1 colspan=5 bgcolor=#ffffff></td>
        </tr>
    </table>
<?php
} catch (PDOException $exception) {
    print "오류 : ".$exception->getMessage();
}
?>
</body>
</html>
