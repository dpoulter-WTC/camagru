<?php
session_start();
$data = $_POST['photo'];
$name = $_POST['user'];
$data = str_replace(" ", "+", $data);
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);
echo 'hi';
echo $_SESSION['curr_user'];
$counter = 0;
while (file_exists($_SESSION['curr_user'] . $counter))
{
  $counter++;
}
file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/photos/".$_SESSION['curr_user'].$counter++.'.jpeg', $data);

die;
?>