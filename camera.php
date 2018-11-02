<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="camera.css" type="text/css" media="all">
  <script src="camera.js"></script>
  <?php
  include_once('redirect.php');
  ?>
</head>
<body>
  <?php
  session_start();
  ?>
  <div class="camera">
    <video id="video">Video stream not available.</video>
    <button id="startbutton">Take photo</button>
    <button id="filter">Filter</button>
  </div>
  <canvas id="canvas" class = >
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box.">
  </div>
  <div class="row">
    <div class="column">
      <?php
      $counter = 0;
      while (file_exists($_SESSION['curr_user'] . $counter))
      {
        echo '<img src="'. $_SESSION['curr_user'] . $counter .'">';
        $counter++;
      }
      ?>
    </div>
  </div>
</body>
</html>
