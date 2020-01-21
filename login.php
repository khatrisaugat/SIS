<?php include("includes/header.php");
      include("queries.php");
      if(!empty($_POST) && $_POST['submit']=='submit'){
        $user_select=$obj->select("users");
        while($user=$user_select->fetch(PDO::FETCH_ASSOC)){
          if($user['username']==$_POST['username'] && $user['password']==md5($_POST['password'])){
            session_start();
            if($user['username']=='admin'){
              $_SESSION['adminlogin']="yes";
            }
            $_SESSION['status']="Success";
            header("Location:display_students.php");
          }
        }
      }
?>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" action="" method="post">
        <h2 class="form-login-heading">sign in now</h2>
        <div class="login-wrap">
          <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
          <br>
          <input type="password" name="password" class="form-control" placeholder="Password">
          <br>
          <button class="btn btn-theme btn-block" name="submit" type="submit" value="submit"><i class="fa fa-lock"></i> SIGN IN</button>
          <hr>
          
        </div>
        <!-- Modal -->
        <!-- modal -->
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>

