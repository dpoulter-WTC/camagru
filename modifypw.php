<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
	<title>Change Password</title>
	<script src="modifypw.js"></script>
</head>
<?php
include('connect.php');
require_once('auth.php');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ($_POST['email'] && $_POST['oldpw'] && auth($_POST['email'], $_POST['oldpw']) == 1)
	{
		$pwd = $_POST['newpw'];
		if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pwd)){
			$error = "Your password is too weak.";
			header('Refresh: 0; URL=modify.php');
		}
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$up = dirname($_SERVER[REQUEST_URI]);
		$sql = "SELECT * FROM users WHERE email =  '" . $_POST['email'] . "'";
		$result = $con->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $con->error);
		}
		if ($result->num_rows === 1) {
			$hashed = hash('whirlpool', $_POST['newpw']);
			$sql = "UPDATE `users` SET `passwd` ='". $hashed . "'WHERE `email` = '" . $_POST['email']."'";
			if ($con->query($sql) === TRUE) {
				echo "Password changed successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
			echo "OK\n";
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
		<h1>Change Password</h1><br>
		<label for="email"><b>Email</b></label>
		<input type="email" placeholder="Enter Email" name="email" id="email" required>
		<br />
		<label for="passwd"><b>Current Password</b></label>
		<input type="password" placeholder="Enter Current Password" name="oldpw" id="oldpw" required>
		<br />
		<label for="newpw"><b>New Password</b></label>
		<input type="password" placeholder="Enter New Password" name="newpw" id="newpw" required>
		<br />
		<label for="cnewpw"><b>Confirm New Password</b></label>
		<input type="password" placeholder="Confirm New Password" name="cnewpw" id="cnewpw" required>
		<button type=button id="button_submit">Submit</button>
	</form>
</div>
</body>
</html>
