<html>
<head>
<script>
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
    window.location = "index.m.php";
}
</script>
<?php
session_start();
?>
</head>
<body>

<h1><?php $_SESSION['curr_user']?></h1>
</body>
</html>
