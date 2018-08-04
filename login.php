

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
        ?>
        <p>User Name:<input type="text" name="username"  /></p>
        <p>User Password:<input type="Password" name="userpw" /></p>
        <p><input type="submit" name="sub" value="Log In"></p>
      </form>
      <?php
header("content-type:text/html;charset=gb2312"); //定义字符集
//由于版本问题全部使用mysqli执行
if(isset($_POST["sub"]))
{session_start();$_SESSION['name'] = $name;
$reslink=mysqli_connect('localhost','root','');
mysqli_select_db($reslink,"forum");
mysqli_query($reslink,"set character set gb2312");
mysqli_query($reslink,"set character_set_results=gb2312");//字符集很重要
$sql="select * from f_user where fname='$name'";
$rs=mysqli_query($reslink,$sql);
while($row=mysqli_fetch_array($rs))
{
  $n=$row["fname"];
  $p=$row['fpw'];
}
if($p!=$pw)
{
?>
<script type="text/javascript">alert("The Password is wrong!");
window.location.href="login.php";
</script>
<?php
}
else{
?>
<script type="text/javascript">
  window.location.href="home.php";
</script>
<?php
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
 