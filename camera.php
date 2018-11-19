<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="camera.css" type="text/css" media="all">
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
  ?>
  <div class="camera">
    <video id="video"muted="muted" width="400" height="400">Video stream not available.</video>
    <button id="startbutton">Take photo</button>
    <button id="filter">Filter</button>
  </div>
  <canvas id="canvas" class = >
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box.">
  </div>
  <form action="photo_upload.php" method="post">
  <div style="width: 200px; height: 100px; overflow-y: scroll;">
    <?php
    $counter = 0;
    while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg'))
    {
      $src = "tmp/".$_SESSION['curr_user'] . $counter .'_edit.jpeg';
      echo '<label>
      <input type="checkbox" name="picture'.$counter.'" value="'.$counter.'" checked>
      <img width="100" height="100" src="'.$src.'" id="'.$counter.'">
      </label>';

      $counter++;
    }
    ?>
  </div>
  <input type="hidden" name="hidden" value="1">
  <input type="submit" value="Submit">
</form>
  <button id="continue">continue</button>
</body>
</html>
