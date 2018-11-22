<?php
include_once('redirect.php');
$counter = 0;
if (isset($_POST['hidden'])){
  include('connect.php');

  $sql = "SELECT id FROM users WHERE login = '" . $_SESSION['curr_user'] ."'";
  $result = $con->query($sql);
  while($row = $result->fetch_assoc()) {
    $user_id = $row['id'];
  }
  echo $user_id;
  $count = 0;

  while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg'))
  {

    if (isset($_POST['picture'.$counter]))
    {
      $data = file_get_contents("tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg');
      unlink("tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg');
      while (file_exists("photos/".$_SESSION['curr_user'] . $count .'.jpeg'))
      {
        $count++;
      }
      $url = "photos/".$_SESSION['curr_user'].$count.'.jpeg';
      file_put_contents($url, $data);

      $sql = "INSERT INTO photos (userid, url, likes, comments, creation_date) VALUES ('$user_id','$url', '0' , '0', '".date("Y-m-d H:i:s")."')";
			if ($con->query($sql) === TRUE) {
				echo "New record created successfully";
				header('Refresh: 0; URL=index.php');
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
    }
    $counter++;
  }
  $counter = 0;
  while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'.jpeg'))
  {
    unlink("tmp/".$_SESSION['curr_user'] . $counter .'.jpeg');
    $counter++;
  }
} else{
  $data = $_POST['photo'];
  $data = str_replace(" ", "+", $data);
  list($type, $data) = explode(';', $data);
  list(, $data)      = explode(',', $data);
  $data = base64_decode($data);
  if (isset($_POST['edit']))
  {
    while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg'))
    {
      $counter++;
    }
    file_put_contents("tmp/".$_SESSION['curr_user'].$counter.'_edit.jpeg', $data);
  }else {
    while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'.jpeg'))
    {
      $counter++;
    }
    file_put_contents("tmp/".$_SESSION['curr_user'].$counter.'.jpeg', $data);
  }
  die;
}
?>
