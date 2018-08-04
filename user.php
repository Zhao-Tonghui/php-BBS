<!DOCTYPE html>
<html>
  <head>
    <title>PHP-BBS</title>
    <link rel="stylesheet" type="text/css" href="ys.css">
  </head> 

  <body>
<?php
header("content-type:text/html;charset=gb2312"); //定义字符集
//由于版本问题全部使用mysqli执行
$reslink=mysqli_connect('localhost','root','');
mysqli_select_db($reslink,"forum");
mysqli_query($reslink,"set character set gb2312");
mysqli_query($reslink,"set character_set_results=gb2312");
?>
    <div id="header">
      <img id="headerLogo"
           src="images/head.png" alt="PHP-BBS-logo">
      <div id="index">
        <a href="home.php">Home</a>
      </div>
    </div>

    <div id="main">
      <h2>user name:
        <?php 
        session_start();
        $name=$_SESSION['name'];//传入用户名
        echo $name;
        ?>
        </h2>
        <p>user id:
          <?php //显示用户具体信息
          $sql="select fid from f_user where fname='$name';";
          $rs=mysqli_query($reslink,$sql);
          while($row=mysqli_fetch_array($rs))
          {
            $uid=$row['fid'];
            echo $row['fid'];
          }
          ?>
        </p>
        <p>user email:
          <?php
          $sql="select email from f_user where fname='$name';";
          $rs=mysqli_query($reslink,$sql);
          while($row=mysqli_fetch_array($rs))
          {
            echo $row['email'];
          }
          ?>
        </p>
    </div>

    <div id="main1">
      <h1>The published post</h1>
        <?php //显示用户已发表的帖子
          $sql="select bname from f_blog where userid=(select fid from f_user where fname='$name');";
          $rs=mysqli_query($reslink,$sql);
          while($row=mysqli_fetch_array($rs))
          {
            echo "<p>Theme:".$row['bname']."</p>";
          }
          ?>
    </div>

    <div id="main2">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p>Publish a theme:<input type="text" name="bname"/></p>
        <p>cotent:<textarea cols="20" rows="5" name="blog"></textarea>
        <input type="submit" name="sub" value="publish"></p>
      </form>
      <?php  //添加新帖子
      header("content-type:text/html;charset=gb2312"); 
      if(isset($_POST["bname"]))
          $bname=$_POST["bname"];
      if(isset($_POST["blog"]))
          $blog=$_POST["blog"];
      if(isset($_POST["sub"]))
      {
      $sql="insert into f_blog(bname,blog,time,userid) values ('$bname','$blog',now(),$uid)" ;
      if ($reslink->query($sql) === TRUE) {
      ?>
      <script type="text/javascript">
        alert("Success!");
      window.location.href="user.php";
      </script>
      <?php
       }
      else {
         echo "Error: " . $sql . "<br>" . $reslink->error;
       }
      $reslink->close();
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
