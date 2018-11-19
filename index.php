<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="style/style.css"/>
  <script>
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
    window.location = "index.m.php";
  }
</script>
<?php
if(!isset($_SESSION))
{
  session_start();
}
?>
<head>
  <?php
  if (!file_exists("photos"))
  {
    mkdir("photos");
  }
  if (!file_exists("tmp"))
  {
    mkdir("tmp");
  }
  ?>
  <style>
  div.gallery {
    border: 1px solid #ccc;
  }

  div.gallery:hover {
    border: 1px solid #777;
  }

  div.gallery img {
    width: 100%;
    height: auto;
  }

  div.desc {
    padding: 15px;
    text-align: center;
  }

  * {
    box-sizing: border-box;
  }

  .responsive {
    padding: 0 6px;
    float: left;
    width: 24.99999%;
  }

  @media only screen and (max-width: 900px) {
    .responsive {
      width: 49.99999%;
      margin: 6px 0;
    }
  }

  @media only screen and (max-width: 700px) {
    .responsive {
      width: 100%;
    }
  }

  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }
</style>
</head>
<body>
  <?php
  $counter = 0;
  if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
    if (isset($_GET['id']))
    {
      $start = $_GET['id'] * 8;
    } else {
      $start = 0;
    }
  }
  include_once('header.php');
  include('connect.php');
  if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
  $sql = "SELECT * FROM photos ORDER BY creation_date DESC";
  $result = $con->query($sql);
  if (!$result) {
    trigger_error('Invalid query: ' . $con->error);
  }
  ?>
  <div class = "row">
    <?php
    $count = 1;
    while($row = $result->fetch_assoc())
    {
      if($count < $start + 8 && $count >= $start){
      ?>
      <div class="responsive">
        <div class="gallery">
          <?php
          echo '<a target="_blank" href="'.$row['url'].'">
          <img src="'.$row['url'].'" alt="Cinque Terre" width="600" height="400">';
          ?>
          </a>
          <div class="desc">Add a description of the image here</div>
        </div>
      </div>
      <?php
    }
    $count++;
  }
  ?>
</div>
<div class="clearfix"></div>
</body>

</html>
