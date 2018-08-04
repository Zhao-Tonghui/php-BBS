<!DOCTYPE html>
<html>
  <head>
    <title>PHP-BBS</title>
    <link rel="stylesheet" type="text/css" href="ys.css">
  </head> 

  <body>
    <div id="header">
      <img id="headerLogo"
           src="images/head.png" alt="PHP-BBS-logo">
      <div id="index">
        <a href="sign.php">sign in</a>
      </div>
    </div>

    <div id="main">
      <h1>Log In</h1>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <?php
          if(isset($_POST["username"]))
           $name=$_POST["username"];
          if(isset($_POST["userpw"]))
           $pw=$_POST["userpw"];
          if(isset($_POST["realname"]))
           $realname=$_POST["realname"];
          if(isset($_POST["email"]))
           $email=$_POST["email"];
        ?>
        <p>User Name:<input type="text" name="username"  /></p>
        <p>User Password:<input type="Password" name="userpw" /></p>
        <p>User RealName:<input type="text" name="realname"  /></p>
        <p>User Email:<input type="text" name="email"  /></p>
        <p><input type="submit" name="sub" value="Sign In"></p>
      </form>
      <?php
header("content-type:text/html;charset=gb2312"); //定义字符集
//由于版本问题全部使用mysqli执行
if(isset($_POST["sub"]))
{session_start();
  $_SESSION['name'] = $name;
$reslink=mysqli_connect('localhost','root','');
mysqli_select_db($reslink,"forum");
mysqli_query($reslink,"set character set gb2312");
mysqli_query($reslink,"set character_set_results=gb2312");//字符集很重要
$sql="insert into f_user(fpw,fname,flevel,email,realname) values ('$pw','$realname',null,'$email','$realname')" ;
if ($reslink->query($sql) === TRUE) {//判断是否存入成功
?>
<script type="text/javascript">
alert("Success!");
window.location.href="home.php";
</script>
<?php
}
 else {
    echo "Error: " . $sql . "<br>" . $reslink->error;
}
}
?>

    </div>

    <div id="footer">
      &copy; 2018, PHP-BBS
      <br>
      contact with me-18845149114@163.com
    </div>

  </body>
</html>
 