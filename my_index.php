<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
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


		.responsive {
			padding: 0 6px;
			float: left;
			width: calc((100% - 6px * 6) /3);
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
	$sql = "SELECT id FROM users WHERE login = '" . $_SESSION['curr_user'] ."'";
	$result = $con->query($sql);
	$pages = $result->num_rows / 6;
	while($row = $result->fetch_assoc()) {
		$user_id = $row['id'];
	}
	$sql = "SELECT * FROM photos WHERE userid = '".$user_id."' ORDER BY creation_date DESC";
	$result = $con->query($sql);
	if (!$result) {
		trigger_error('Invalid query: ' . $con->error);
	}
	if($result->num_rows === 0)
	{
		echo '<h1> Somehow there are no photos. You can rectify this by adding your own!</h1>';
	}

	?>
	<div class="content">
		<?php
		$count = 1;
		while($row = $result->fetch_assoc())
		{
			if($count < $start + 8 && $count >= $start){
				?>
				<div class="responsive">
					<div class="gallery">
						<?php
						echo '<a target="_blank" href="image.php?img_id='.$row['id'].'">
						<img src="'.$row['url'].'" alt="Error404" width="600" height="400">';
						$sql2 = "SELECT * FROM likes WHERE imgid = '". $row['id'] ."'";
						$result2 = $con->query($sql2);
						$num = $result2->num_rows;
						$sql2 = "SELECT * FROM comments WHERE imgid = '". $row['id'] ."'";
						$result2 = $con->query($sql2);
						$num2 = $result2->num_rows;
						$sql3 = "SELECT login FROM users WHERE id = '" . $row['userid'] ."'";
						$result3 = $con->query($sql3);
						$row3 = $result3->fetch_assoc()
						?>
					</a>
					<?php echo '<div class="desc"><p align="left"> '.$num.'❤ '.$num2.'✉︎<span style="float:right;">'.$row3['login'].'</span></p>
					<form action="delete.php" method="post" id="form'.$row['id'].'">
					<input type="hidden" name="hidden" value="'.$row['id'].'">
					</form>
					<button type="submit" form="form'.$row['id'].'" value="Submit">Delete Image</button>
					</div>';?>
				</div>
			</div>
			<?php
		}
		$count++;
	}
	?>
<div class="clearfix"></div>
<?php
$count = 0;
while ($count < $pages)
{
	?>
  <button class="but" onclick="location.href='my_index.php?id=<?php echo $count?>'"> <?php echo $count?> </button>
  <?php
  $count++;
}
?>
</div>
</body>
</html>
