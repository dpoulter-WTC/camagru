<?php
include_once('redirect.php');
include('connect.php');
$counter = 0;
if (isset($_POST['hidden'])){
	$sql = "SELECT * FROM photos WHERE id = '" . $_POST['hidden'] ."'";
  $result = $con->query($sql);
  while($row = $result->fetch_assoc()) {
    $link = $row['url'];
  }
	unlink($link);
	$sql = "DELETE FROM photos WHERE id = '" . $_POST['hidden'] ."'";
	$result = $con->query($sql);
	$sql = "DELETE FROM likes WHERE imgid = '" . $_POST['hidden'] ."'";
	$result = $con->query($sql);
	$sql = "DELETE FROM comments WHERE imgid = '" . $_POST['hidden'] ."'";
	$result = $con->query($sql);
	header("Location: my_index.php");
}
