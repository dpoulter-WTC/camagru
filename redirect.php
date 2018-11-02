<?php
session_start();
if ($_SESSION['curr_user'] == "")
{
  header("Location: login.php");
}
 ?>
