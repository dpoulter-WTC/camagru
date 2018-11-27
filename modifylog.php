<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
	<title>Change Username</title>
</head>
<?php
include('connect.php');
require_once('auth.php');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ($_POST['email'] && $_POST['oldpw'] && auth($_POST['email'], $_POST['oldpw']) == 1)
	{
		$login = $_POST['newlog'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$sql = "SELECT * FROM users WHERE email =  '" . $_POST['email'] . "'";
		$result = $con->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $con->error);
		}
		if ($result->num_rows === 1) {
			$sql = "UPDATE `users` SET `login` ='". $login . "'WHERE `email` = '" . $_POST['email']."'";
			if ($con->query($sql) === TRUE) {
				header("Location: logout_1.php");
				echo "Username changed successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
			echo "\n";
		}
	}
}
?>
<body>
	<?php
	include_once('header.php');
	?>
	<div class = "create">
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id = "form">
		<h1>Change Username</h1><br>
		<label for="email"><b>Email</b></label>
		<input type="email" placeholder="Enter Email" name="email" id="email" required>
		<br />
		<label for="oldpw"><b>Current Password</b></label>
		<input type="password" placeholder="Enter Current Password" name="oldpw" id="oldpw" required>
		<br />
		<label for="newlog"><b>New Username</b></label>
		<input type="text" placeholder="Enter New Username" name="newlog" id="newlog" required>
	</form>
	<button type="submit" form="form" value="Submit">Submit</button>
</div>
</body>
</html>
