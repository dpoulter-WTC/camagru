<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
	<title>Modify Account</title>
</head>
<body>
	<?php
	include('connect.php');
	include_once('redirect.php');
	include_once('header.php');
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (isset($_POST['notification']))
		{
			$notify = $_POST['notification'];
			if ($notify == 0)
			{
				$sql = "UPDATE users SET notification = 0 WHERE login = '".$_SESSION['curr_user']."'";
				if ($con->query($sql) === TRUE) {
					header("Refresh: 0; URL=modify.php");
				} else {
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			} else {
				$sql = "UPDATE users SET notification = 1 WHERE login = '".$_SESSION['curr_user']."'";
				if ($con->query($sql) === TRUE) {
					header("Refresh: 0; URL=modify.php");
				} else {
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			}
		}
	}
	?>
	<div class = "create">
	<a style = "font-size: 21px" href="modifylog.php">Change Username</a>
  <a style = "font-size: 21px" href="modifypw.php">Change Password</a>
	<form action="modify.php" method="post">
		<?php
		$sql3 = "SELECT * FROM users WHERE login = '" . $_SESSION['curr_user'] . "'";
		$result3 = $con->query($sql3);
		while($row3 = $result3->fetch_assoc()) {
			$notif = $row3['notification'];
		}
		if ($notif == 1)
		{
			echo '<input type="hidden" name="notification" value="0">
			<input type="submit" value="Turn email notifications off">';
		}else {
			echo '<input type="hidden" name="notification" value="1">
			<input type="submit" value="Turn email notifications on">';
		}

		?>
	</div>
	</form>
</body>
</html>
