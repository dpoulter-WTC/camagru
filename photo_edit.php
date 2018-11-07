<!DOCTYPE html>
<html>
<body>

<p>Image to use:</p>
<img id="scream" src="resources/profile/profile.jpg" alt="The Scream">
<img id="sticker" width="100" height="100" src="resources/stickers/09.png" alt="The Scream">

<p>Canvas:</p>
<canvas id="myCanvas" width="240" height="297" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.
</canvas>

<script>
window.onload = function() {
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    var img = document.getElementById("scream");
    var sticker = document.getElementById("sticker");
    ctx.drawImage(img, 1, 1);
    addSticker(ctx, sticker);
}
function addSticker(ctx, sticker, position)
{
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
  ctx.drawImage(sticker, x, y, 50, 50);
}
</script>
</body>
</html>
