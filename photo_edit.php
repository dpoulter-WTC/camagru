<!DOCTYPE html>
<html>
<body>

  <p>Image to use:</p>
  <img id="original" src="resources/profile/profile.jpg" alt="Original Image">

  <?php
  $counter = 1;
  while (file_exists("resources/stickers/sticker (". $counter .').png'))
  {
    $src = "resources/stickers/sticker (". $counter .').png';
    echo '<label>
    <input type="radio" name="sticker" value="1">
    <img width="100" height="100" src="'.$src.'" id="'.$counter.'">
    </label>';
    $counter++;
  }
  ?>
  <button onclick="addSticker(ctx, 'topLeft')">Click me</button>

  <p>Canvas:</p>
  <canvas id="myCanvas" width="400" height="400" style="border:1px solid #d3d3d3;">
    Your browser does not support the HTML5 canvas tag.
  </canvas>

  <script>
  window.onload = function() {
    c = document.getElementById("myCanvas");
    ctx = c.getContext("2d");
    var img = document.getElementById("original");
    var sticker = document.getElementById("sticker1");
    ctx.drawImage(img, 1, 1);
  }
  function addSticker(ctx, position)
  {
    c2 = document.getElementById("myCanvas");
    ctx2 = c2.getContext("2d");
    var radios = document.getElementsByName('sticker');
    var counter = 0;
    while(counter < radios.length) {
      if (radios[counter].checked) {
        break;
      }
      counter++;
    }
    counter++;
    var sticker = document.getElementById(counter);
    var x;
    var y;
    if (position == 'topLeft')
    {
      x = 10;
      y = 10;
    }
    else if (position == 'topRight')
    {

    }
    else if (position == 'bottomLeft')
    {

    }
    else if (position == 'bottomRight')
    {

    }
    else if (position == 'centre')
    {

    }
    ctx2.drawImage(sticker, x, y, 50, 50);
  }
</script>
</body>
</html>
