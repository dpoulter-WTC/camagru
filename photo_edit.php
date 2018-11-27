<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style/style.css"/>
  <style>
  input[type="radio"] {
    display: none
  }
  img {
    border: 4px solid red;
  }
  input[type="radio"]:checked:before + img
  {
    background: green;
    border: 4px solid red;
  }
  input[type="radio"]:checked + img
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
  include_once('redirect.php');
  include_once('header.php');
  $counter = 0;
  while (file_exists("tmp/".$_SESSION['curr_user'] . $counter .'.jpeg'))
  {
    $counter++;
  }
  $counter--;
  if ($counter == -1){
    header("Location: index.php");
    die();
  }
  echo '<img id="original" src="tmp/'. $_SESSION['curr_user'] . $counter .'.jpeg" alt="Original Image" hidden>';
  ?>
  <div class = "center">
    <div class="slider" style="direction: rtl;">
      <?php
      $counter = 1;
      while (file_exists("resources/stickers/sticker (". $counter .').png'))
      {
        $src = "resources/stickers/sticker (". $counter .').png';
        echo '<label>
        <input type="radio" name="sticker" value="1">
        <img width="100" height="100" src="'.$src.'" id="sticker-'.$counter.'">
        </label>';
        $counter++;
      }
      ?>
      <button onclick="addSticker(ctx, 'topLeft')">Top Left</button>
      <button onclick="addSticker(ctx, 'topRight')">Top Right</button>
      <button onclick="addSticker(ctx, 'bottomLeft')">Bottom Left</button>
      <button onclick="addSticker(ctx, 'bottomRight')">Bottom Right</button>
    </div>
    <canvas id="myCanvas" width="500" height="500" style="border:1px solid #d3d3d3;">
    </canvas>
    <div class="slider">
      <?php
      $counter = 1;
      while (file_exists("resources/borders/border (". $counter .').png'))
      {
        $src = "resources/borders/border (". $counter .').png';
        echo '<label>
        <input type="radio" name="border" value="1">
        <img width="100" height="100" src="'.$src.'" id="border-'. $counter .'">
        </label>';
        $counter++;
      }
      ?>
      <button onclick="addBorder(ctx)">Add Border</button>
    </div>
  </div>
  <button onclick="ctx.drawImage(original, -83.33, 0, 666.66666666, 500)">Reset</button>
  <button onclick="saveImage()">Save Image</button>

  <script>
  window.onload = function() {
    c = document.getElementById("myCanvas");
    ctx = c.getContext("2d");
    var img = document.getElementById("original");
    ctx.drawImage(img, -83.33, 0, 666.66666666, 500);
  }
  function addSticker(ctx, position)
  {
    var stuck = 0;
    c2 = document.getElementById("myCanvas");
    ctx2 = c2.getContext("2d");
    var radios = document.getElementsByName('sticker');
    var counter = 0;
    while(counter < radios.length) {
      if (radios[counter].checked) {
        counter++;
        var sticker = document.getElementById('sticker-' + counter);
        var x;
        var y;
        if (position == 'topLeft')
        {
          x = 40;
          y = 40;
        }
        else if (position == 'topRight')
        {
          x = 360;
          y = 40;
        }
        else if (position == 'bottomLeft')
        {
          x = 40;
          y = 360;
        }
        else if (position == 'bottomRight')
        {
          x = 360;
          y = 360;
        }
        ctx2.drawImage(sticker, x, y, 100, 100);
        stuck = 1;
        break;
      }
      counter++;
    }
    if (stuck == 0)
    {
      alert("Please select a sticker.")
    }
  }
  function addBorder(ctx)
  {
    c2 = document.getElementById("myCanvas");
    ctx2 = c2.getContext("2d");
    var radios = document.getElementsByName('border');
    var counter = 0;
    var stuck = 0;
    while(counter < radios.length) {
      if (radios[counter].checked) {
        counter++;
        var border = document.getElementById('border-' + counter);
        ctx2.drawImage(border, 1, 1, 500, 500);
        stuck = 1;
        break;
      }
      counter++;
    }
    if (stuck == 0)
    {
      alert("Please select a border.")
    }
  }
  function leave() {
    window.location = "camera.php";
  }
  function saveImage()
  {
    canvas = document.getElementById("myCanvas");
    var dataURL = canvas.toDataURL('image/jpeg');
    xhr = new XMLHttpRequest();
    xhr.open('POST', 'photo_upload.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status !== 200) {
        alert('Request failed.  Returned status of ' + xhr.status);
      }
    };
    xhr.send(encodeURI('photo=' + dataURL + '&edit=1'));
    setTimeout("leave()", 500);
  }
  </script>
</body>
</html>
