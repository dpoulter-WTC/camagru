<?php
include_once('redirect.php');
$counter = 0;
if (isset($_POST['submit'])){
  while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'.jpeg'))
  {
    $counter++;
  }
  $target_file = "tmp/".$_SESSION['curr_user'] . $counter .'.jpeg';
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["upload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
        header("Location: photo_edit.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}else {
if (isset($_POST['hidden'])){
  include('connect.php');

  $sql = "SELECT id FROM users WHERE login = '" . $_SESSION['curr_user'] ."'";
  $result = $con->query($sql);
  while($row = $result->fetch_assoc()) {
    $user_id = $row['id'];
  }
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
}}
?>
