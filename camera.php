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
</body>
</html>
