<?php
if(!isset($_SESSION))
{
  session_start();
}
if ($_SESSION['curr_user'] == "")
{
  header("Location: login.php");
}
 ?>
