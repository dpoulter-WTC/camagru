<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="style/style.css"/>
  <link rel="stylesheet" href="style/camera.css" type="text/css" media="all">
  <script src="camera.js"></script>
  <?php
  include_once('redirect.php');
  ?>
  <style>
  input[type="checkbox"] {
    display: none
  }
  img {
    border: 4px solid red;
  }
  input[type="checkbox"]:checked:before + img
  {
    background: green;
    border: 4px solid red;
  }
  input[type="checkbox"]:checked + img
  {
    border-color:green;
    border: 4px solid green;
  }
  .checkbox label {
    margin-bottom: 20px !important;
  }
  </style>
</head>
<body>
  <?php
  if(!isset($_SESSION))
  {
    session_start();
  }
  include_once('header.php');
  ?>
  <div class="page">
    <div class="box">
      <div class="camera">
        <video id="video"muted="muted" width="400" height="400">Video stream not available.</video>
        <button id="startbutton">Take photo</button>
      </div>
      <div class="slider2">
        <form action="photo_upload.php" method="post">
          <div class="slider">
            <?php
            $counter = 0;
            while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg'))
            {
              $src = "tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg';
              echo '<label style="margin-left: auto;	margin-right: auto; position:relative;">
              <input type="checkbox" name="picture'.$counter.'" value="'.$counter.'" checked>
              <img width="120" height="120" style="margin-left: auto;	margin-right: auto; position:relative;" src="'.$src.'" id="'.$counter.'">
              </label>';

              $counter++;
            }
            ?>
          </div>
          <input type="hidden" name="hidden" value="1">
          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
    <div class = "next">
        <button id="continue">continue</button>
    </div>
  </div>
  <canvas id="canvas" class = >
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box.">
  </div>


</body>
</html>
