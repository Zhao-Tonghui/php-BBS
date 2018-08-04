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
        <a href="login.php">log in</a>&nbsp <a href="sign.php">sign in</a>
      </div>
    </div>

    <div id="main">
      <h1>Topical Subject</h1>

      <?php

header("content-type:text/html;charset=gb2312"); //定义字符集
//由于版本问题全部使用mysqli执行
$reslink=mysqli_connect('localhost','root','');
mysqli_select_db($reslink,"forum");
mysqli_query($reslink,"set character set gb2312");
mysqli_query($reslink,"set character_set_results=gb2312");//字符集很重要
$sql="select * from f_blog ";
$rs=mysqli_query($reslink,$sql);
//查询所有符合条件的记录并显示出来。

while($row=mysqli_fetch_array($rs))
{if (!session_id()) session_start();
echo "<h2>Theme:<a href='review.php'>{$row['bname']}</a></h2>";//获取数据
$_SESSION['blog'] = $row['bname'];
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
