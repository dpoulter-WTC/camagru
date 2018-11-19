<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Token</title>
</head>
<body>
	<?php
	require_once('connect.php');
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token']))
	{
		$sql = "SELECT * FROM users WHERE token = '". $_GET['token'] ."'";
		$result = $con->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $con->error);
		}
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) {
				if ($row['confirmed'] == 0)
				{
					$sql2 = "UPDATE users SET confirmed='1' WHERE token='".$_GET['token']."'";
					$result2 = $con->query($sql2);
					echo '<h1> Email confirmed </h1>';
					echo '<form action="login.php">
					<input type="submit" value="Login" />
					</form>';
				}else {
					echo '<h1> Email already confirmed </h1>';
				}
			}
		}
		else {
			?> <h1> Token incorrect </h1><?php
		}
	}else {
		echo '<h1> Please activate your account via email and then <a href="login.php">click here</a></h1>';
	}
	?>
</body>
</html>
