<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="style/style.css"/>
	<meta charset="UTF-8">
	<title>Image</title>
</head>
<body>
	<?php
	include('connect.php');
	include_once('redirect.php');
	include_once('header.php');
	$sql2 = "SELECT id FROM users WHERE login = '" . $_SESSION['curr_user'] ."'";
	$result2 = $con->query($sql2);
	while($row2 = $result2->fetch_assoc()) {
		$user_id = $row2['id'];
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (isset($_POST['hidden']))
		{
			$img_id = $_POST['hidden'];
			if ($_POST['like'] == 1)
			{
				$sql = "INSERT INTO likes (userid, imgid) VALUES ('$user_id','$img_id')";
				$con->query($sql);
				$sql = "UPDATE photos SET likes = likes + 1 WHERE id='$img_id'";
				if ($con->query($sql) === TRUE) {
					header("Refresh: 0; URL=image.php?img_id=$img_id");
				} else {
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			} else {
				$sql = "DELETE FROM likes WHERE userid = $user_id";
				$con->query($sql);
				$sql = "UPDATE photos SET likes = likes - 1 WHERE id='$img_id'";
				if ($con->query($sql) === TRUE) {
					header("Refresh: 0; URL=image.php?img_id=$img_id");
				} else {
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			}
		}
		if (isset($_POST['hidden_comment']) && isset($_POST['commentblock']))
		{
			$img_id = $_POST['hidden_comment'];
			$comme = $_POST['commentblock'];
			$sql = "INSERT INTO comments (userid, imgid, content, creation_date) VALUES ('$user_id','$img_id', '$comme', '".date("Y-m-d h:m:s")."')";
			$con->query($sql);
			$sql = "UPDATE photos SET comments = comments + 1 WHERE id='$img_id'";
			if ($con->query($sql) === TRUE) {
				$emailid = "SELECT userid FROM photos WHERE id = '" . $img_id ."'";
				$emailresult = $con->query($emailid);
				while($row100 = $emailresult->fetch_assoc()) {
					$user_id2 = $row100['userid'];
				}

				$emailcon = "SELECT * FROM users WHERE id = '" . $user_id2 ."'";
				$emailresultcon = $con->query($emailcon);
				while($row100 = $emailresultcon->fetch_assoc()) {
					$con = $row100['notification'];
					$username = $row100['login'];
					$email = $row100['email'];
				}

				if ($con == 1)
				{
					$up = dirname($_SERVER['REQUEST_URI']);
					$msg = "
					<html>
					<head>
					<title>New comment</title>
					</head>
					<body>
					<p>Hello ".$username."</p>
					</br>
					<p>You have got a new comment on you photo:</p>
					</br>
					<a href=http://$_SERVER[HTTP_HOST]$up/image.php?img_id=$img_id>Check it out now</a>
					</body>
					</html>
					";
				}
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$success = mail($email ,"Confirm Email",$msg, $headers);
				if (!$success) {
					$errorMessage = error_get_last()['message'];
				} else {
					header("Refresh: 0; URL=image.php?img_id=$img_id");
				}

			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
		}
	}
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if (isset($_GET['img_id']))
		{
			$img_id = $_GET['img_id'];
			$sql = "SELECT * FROM photos WHERE id = '" . $img_id ."'";
			$result = $con->query($sql);
			if ($result->num_rows === 1) {
				while($row = $result->fetch_assoc()) {
					$user = $row['userid'];
					$image_url = $row['url'];

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
			?>
			<form action="image.php" method="post">
				<?php
				$sql3 = "SELECT * FROM likes WHERE userid = '" . $user_id ."' and imgid = '". $_GET['img_id'] ."'";
				$result3 = $con->query($sql3);
				if ($result3->num_rows == 1)
				{
					echo '<input type="hidden" name="hidden" value="'.$_GET['img_id'].'">
					<input type="hidden" name="like" value="0">';
					$sql2 = "SELECT * FROM likes WHERE imgid = '". $_GET['img_id'] ."'";
					$result2 = $con->query($sql2);
					$num = $result2->num_rows;
					echo '<p align="left"> '.$num.'❤</p>
					<input type="submit" value="Unlike">';
				}else {
					echo '<input type="hidden" name="hidden" value="'.$_GET['img_id'].'">
					<input type="hidden" name="like" value="1">
					<input type="submit" value="Like">';
				}
				?>
			</form>
			<table>
				<?php
				$comment_sql = "SELECT * FROM comments WHERE imgid = '". $_GET['img_id'] ."'";
				$comment = $con->query($comment_sql);
				while($com = $comment->fetch_assoc()) {
					$sql2 = "SELECT login FROM users WHERE id = '" . $com['userid'] ."'";
					$result2 = $con->query($sql2);
					while($row2 = $result2->fetch_assoc()) {
						$login = $row2['login'];
					}
					echo '<tr><td>'.$login.'</td><td>'.$com['content'].'</td></tr>';
				}
				?>
				<form action="image.php" method="post">
					<?php echo '<input type="hidden" name="hidden_comment" value="'.$_GET['img_id'].'">
					<input type="text" name="commentblock" value="">
					<input type="submit" value="Add comment">';?>
				</form>
				<?php
			}else {
				header("Location: index.php");
			}
		}
		?>
	</body>
	</html>
