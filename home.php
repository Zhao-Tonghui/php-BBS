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
        <?php 
        session_start(); 
        $name=$_SESSION['name'];//session获取用户名
        echo "<a href='user.php'>".$name."</a>";
        ?>
      </div>
    </div>

    <div id="main">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">     
<p>Blog Name:<input type="text" name="blogname" />
<input type="submit" value="Search" name="sub"/></p>
      <h1>Topical Subject</h1>
      <?php
if(isset($_POST["blogname"]))
 $bname=$_POST["blogname"];
header("content-type:text/html;charset=gb2312"); //定义字符集
//由于版本问题全部使用mysqli执行
$reslink=mysqli_connect('localhost','root','');
mysqli_select_db($reslink,"forum");
mysqli_query($reslink,"set character set gb2312");
mysqli_query($reslink,"set character_set_results=gb2312");//字符集很重要
$sql="select * from f_blog ";
$rs=mysqli_query($reslink,$sql);
while($row=mysqli_fetch_array($rs))
{
  $aname=$row['bname'];
  echo "<h2>Theme:";  //链接帖子主题
  ?>
  <a href="review.php?id=<?php echo $aname;?>">
  <?php
  echo "$aname</a></h2>";
}
if(isset($_POST["sub"]))
{$_SESSION['blog'] = $bname;//session保留搜查功能的主题，传到下一页面
?>
<script type="text/javascript">
alert("Success!");
window.location.href="review.php";
</script>
<?php
}
?>
</form>
    </div>

    <div id="footer">
      &copy; 2018, PHP-BBS
      <br>
      contact with me-18845149114@163.com
    </div>

  </body>
</html>