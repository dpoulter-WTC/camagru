<html>
<head>
	<title>Logout</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php
session_start();
$_SESSION['curr_user'] = '';
?>
<html>
<body>
  <div id="body_wrapper">
    <div id="wrapper">
      <?php include_once('header2.php');
      ?>
      <div id="middle_subpage">
        <h2>Logged out</h2>
      </div>
      <div class="logout">
        <h1>Successfully logged out</h1>
      </div>
      <div id="tm_bottom"></div>
      <div id="footer">
        Copyright © 2018 <a href="#">WTC_Students</a>
      </div>
    </div>
    <div class="cleaner"></div>
  </div>
  <?php
  header('Refresh: 3; URL=home.php');
  ?>
</body>
</html>
