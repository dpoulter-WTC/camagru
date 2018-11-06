<!DOCTYPE html>
<html>
<body>

<p>Image to use:</p>
<img id="scream" width="220" height="277" src="resources/profile/profile.jpg" alt="The Scream">
<img id="sticker" width="220" height="277" src="resources/stickers/09.png" alt="The Scream">

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
    ctx.drawImage(img, 10, 10);
    ctx.drawImage(sticker, 10, 10);
}
</script>

<p><strong>Note:</strong> The canvas tag is not supported in Internet
Explorer 8 and earlier versions.</p>

</body>
</html>
