<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image</title>
</head>
<body>
	<?php
		$con=mysqli_connect("localhost","camagru","password","camagru");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$img_id = $_GET['img_id'];
		$sql = "SELECT * FROM photos WHERE id = '" . $img_id ."'";
		$result = $con->query($sql);
		if ($result->num_rows === 1) {
			while($row = $result->fetch_assoc()) {
				$user = $row['userid'];
				$image_url = $row['url'];
				$date = $row['creation_date'];
			}
		}
		else {
			echo "404: Image not found!";
		}
		$sql = "SELECT * FROM users WHERE id = '" . $user ."'";
		$result = $con->query($sql);
		if ($result->num_rows === 1) {
			while($row = $result->fetch_assoc()) {
				$user = $row[''];
				$image_url = $row['url'];
				$date = $row['creation_date'];
			}
		}
		else {
			echo "404: Image not found!";
		}
		echo '<img src="' . $image_url . '">' . "\n";
		echo $user . "\n";
		echo $date . "\n";
	?>

</body>
</html>
