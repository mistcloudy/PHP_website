
<?php
session_start();

if(isset($_COOKIE["login"])) {
    $_SESSION["userid"]=$_COOKIE["login"];
    $_SESSION["name"]=$_COOKIE["login1"];
    $_SESSION["nick"]=$_COOKIE["login2"];
    $_SESSION["leve"]=$_COOKIE["login3"];

}


?>
<!DOCTYPE html>
 <html>
 <head>
    
     <meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="./css/common.css">
 </head>

<body>


 <div id="wrap">

 <div id="header">

 <?php include "./lib/top_login1.php"; ?>

 </div> <!-- end of header -->

 <div id="menu">

 <?php include "./lib/top_menu1.php"; ?>

 </div> <!-- end of menu -->
     <div id = "content">
         <div id ="main_img"><img src = "img/main_img.jpg"></div>
     </div> <!--end of content -->
 </div> <!-- end of wrap -->

</body>
</html>