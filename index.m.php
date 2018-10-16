<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style/mobile.css"/>
  <script>
  if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
    window.location = "index.php";
  }
</script>
</head>
<body>
  <?php
  session_start();
  require_once('auth.php');
  //include_once('sidebar.php');
  $message = "";
  $usertip = "Enter Username";
  $passtip = "Enter Password";
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $login = $_POST['login'];
    $passwd = $_POST['passwd'];
    if ($login && $passwd && auth($login, $passwd))
    {
      $_SESSION['logged_on_user'] = $login;
      header('Location: page_index.php');
    }
    else if ($login && $passwd)
    {
      $message = "Incorrect login credentials";
    }
  }
  ?>
  <div class = "full">
    <div class = "center">
      <div class="container">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
          <div class="row">
            <h2 style="text-align:center">Login with Social Media or Manually</h2>
            <div class="vl">
              <span class="vl-innertext">or</span>
            </div>

            <div class="col">
              <a href="#" class="fb btn">
                <i class="fa fa-facebook fa-fw"></i> Login with Facebook
              </a>
              <a href="#" class="twitter btn">
                <i class="fa fa-twitter fa-fw"></i> Login with Twitter
              </a>
              <a href="#" class="google btn"><i class="fa fa-google fa-fw">
              </i> Login with Google+
            </a>
          </div>

          <div class="col">
            <div class="hide-md-lg">
              <p>Or sign in manually:</p>
            </div>

            <input type="text" name="login" placeholder="login" required>
            <input type="password" name="passwd" placeholder="password" required>
            <?php echo "<b style='color:red;'>".$message."</b><br>"; ?>
            <input type="submit" value="OK">
          </div>

        </div>
      </form>
    </div>

    <div class="bottom-container">
      <div class="row">
        <div class="col">
          <a href="#" style="color:white" class="btn">Sign up</a>
        </div>
        <div class="col">
          <a href="#" style="color:white" class="btn">Forgot password?</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
