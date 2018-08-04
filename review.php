<!DOCTYPE html>
<html>
  <head>
    <title>PHP-BBS</title>
    <link rel="stylesheet" type="text/css" href="ys.css">
  </head> 

  <body>
<?php
header("content-type:text/html;charset=gb2312"); 
$reslink=mysqli_connect('localhost','root','');
mysqli_select_db($reslink,"forum");
mysqli_query($reslink,"set character set gb2312");
mysqli_query($reslink,"set character_set_results=gb2312");
if (!session_id()) session_start();
$name=$_SESSION['name'];//传入用户名
if(isset($_SESSION['blog']))
{
  $bname=$_SESSION['blog'];//传入主题
  unset($_SESSION['blog']);
}  
if(isset($_GET['id']))
 { 
  $bname=$_GET['id'];//传入搜查功能的主题
 }
$sql="select * from f_user where fname='$name';";
$rs=mysqli_query($reslink,$sql);
while($row=mysqli_fetch_array($rs))
 {
      $uid=$row['fid'];
}
?>
    <div id="header">
      <img id="headerLogo"
           src="images/head.png" alt="PHP-BBS-logo">
      <div id="index">
        <a href="home.php">Home</a>
      </div>
    </div>

    <div id="main">
      <h2>Theme:
        <?php 
        echo $bname;
        ?>
        </h2>
        <p style="font-size: 50%;">publish time:
          <?php //显示帖子具体信息
          $sql="select * from f_blog where bname='$bname';";
          $rs=mysqli_query($reslink,$sql);
          while($row=mysqli_fetch_array($rs))
          {
            echo $row['time'];
            $bid=$row['bid'];
          }
          ?>&nbsp;&nbsp;
          author:
          <?php
          $sql="select fname from f_user where fid=(select userid from f_blog where bname='$bname');";
          $rs=mysqli_query($reslink,$sql);
          while($row=mysqli_fetch_array($rs))
          {
            echo $row['fname'];
          }
          ?>
        </p>
        <p>content:</p>
        <p style="font-size: 60%;"><pre>
          <?php
          $sql="select * from f_blog where bname='$bname';";
          $rs=mysqli_query($reslink,$sql);
          while($row=mysqli_fetch_array($rs))
          {
            echo $row['blog'];
          }
          ?>
          </pre>
        </p>
    </div>

    <div id="main1">
      <h1>Review</h1>
      <table border="1"><tr>
          <?php  //显示帖子的评论
          $sql="select b.time,a.fname,c.review,a.fid from f_user a,f_blog b,f_review c where a.fid=c.userid and c.blogid=b.bid and b.bid='$bid';";
          $rs=mysqli_query($reslink,$sql);
          if (!$rs) {
          printf("Error: %s\n", mysqli_error($reslink));
          exit();
        }
          while($row=mysqli_fetch_array($rs))
          {
            echo '<p style="font-size: 50%;"><td>time:';
            echo $row['time'];
            echo "</td><td>author:".$row['fname']."</td></p>";
          echo "</tr><tr><td colspan=2>Review:".$row['review']."</td></tr>";
          }
          ?>
        </table>
    </div>

    <div id="main2">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <p>Publish a Review:<input type="text" name="review"/></p>
        <input type="submit" name="sub" value="review"></p>
      </form>
      <?php //form表单，添加新的评论
      if(isset($_POST["review"]))
          $review=$_POST["review"];
      if(isset($_POST["sub"]))
      {
      $sql="insert into f_review(review,time,userid,blogid) values('$review',now(),$uid,1002);" ;
      if ($reslink->query($sql) === TRUE) {
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
