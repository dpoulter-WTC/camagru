<!DOCTYPE html>
<html>
<body>

<p>Image to use:</p>
<img id="original" src="resources/profile/profile.jpg" alt="Original Image">

<label>
  <input type="radio" name="test" value="small" checked>
  <img width="100" height="100" src="resources/stickers/BuyMeStuff.png">
</label>
<label>
  <input type="radio" name="test" value="big">
  <img width="100" height="100" src="resources/stickers/BlackCat.png">
</label>


<img id="sticker3" width="100" height="100" src="resources/stickers/ColourSkull.png" alt="Sticker 3">
<img id="sticker4" width="100" height="100" src="resources/stickers/CrystalWolf.png" alt="Sticker 4">
<img id="sticker5" width="100" height="100" src="resources/stickers/DabbingSquidward.png" alt="Sticker 5">
<img id="sticker6" width="100" height="100" src="resources/stickers/DontTouch.png" alt="Sticker 6">
<img id="sticker7" width="100" height="100" src="resources/stickers/Elephant.png" alt="Sticker 7">
<img id="sticker8" width="100" height="100" src="resources/stickers/Ew.png" alt="Sticker 8">
<img id="sticker9" width="100" height="100" src="resources/stickers/FlowerYinYang.png" alt="Sticker 9">
<img id="sticker10" width="100" height="100" src="resources/stickers/OhNoTigger.png" alt="Sticker 10">
<img id="sticker11" width="100" height="100" src="resources/stickers/RainbowSloth.png" alt="Sticker 11">
<img id="sticker12" width="100" height="100" src="resources/stickers/UnluckyCat.png" alt="Sticker 12">
<img id="sticker13" width="100" height="100" src="resources/stickers/WatercolourFlower.png" alt="Sticker 13">

<p>Canvas:</p>
<canvas id="myCanvas" width="400" height="400" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.
</canvas>

<script>
window.onload = function() {
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    var img = document.getElementById("original");
    var sticker = document.getElementById("sticker1");
    ctx.drawImage(img, 1, 1);
    addSticker(ctx, sticker, 'topLeft');
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
