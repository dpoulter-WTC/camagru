<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image</title>
</head>
<body>
	<?php
	include('connect.php');
	function addLike($likes, $img_id, $user)
	{
		$sql = "UPDATE `photos` SET `likes` = ($likes + 1) WHERE `id` = $img_id";
		$sql2 = "INSERT INTO `likes` (userid, imgid) VALUES ($user, $img_id)";
		$con->query($sql);
		$con->query($sql2);
	}
	function removeLike()
	{
		$sql = "UPDATE `photos` SET `likes` = ($likes - 1) WHERE `id` = $img_id";
	}
	function removeComment()
	{

	}
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if ($_GET['img_id'])
		{
			$img_id = $_GET['img_id'];
			$sql = "SELECT * FROM photos WHERE id = '" . $img_id ."'";
			$result = $con->query($sql);
			if ($result->num_rows === 1) {
				while($row = $result->fetch_assoc()) {
					$user = $row['userid'];
					$image_url = $row['url'];
					$date = $row['creation_date'];
					$likes = $row['likes'];
					$comments = $row['comments'];
				}
			}
			else {
				echo "404: Image not found!";
			}
			$sql = "SELECT * FROM users WHERE id = '" . $user ."'";
			$result = $con->query($sql);
			if ($result->num_rows === 1) {
				while($row = $result->fetch_assoc()) {
					$name = $row['login'];
				}
			}
			else {
				echo "No user logged in.";
			}

			echo '<img src="' . $image_url . '">' . "\n";
			echo $name . "\n";
			echo $date . "\n";
			echo "<button onclick=". addLike($likes, $img_id, $user) . ">Like</button>";
		}


	}
	?>

</body>
</html>
