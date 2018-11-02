<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create</title>
	<link rel="stylesheet" href="style.css"/>
</head>
<?php
require_once('config/database.php');
$con=mysqli_connect("localhost","camagru","password","camagru");
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ($_POST['login'] && $_POST['passwd'])
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		//$msg = "Hello ".$_POST['login']."\n\n Please click the following link to confirm your account.\n\n
		//				".print("<a href=10.0.1.11/camagru/camera.php>Confirm</a>");
		$msg = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<p>This email contains HTML Tags!</p>
		<a href=https://10.0.1.11/camagru/camera.php>Confirm</a>
		<table>
		<tr>
		<th>Firstname</th>
		<th>Lastname</th>
		</tr>
		<tr>
		<td>John</td>
		<td>Doe</td>
		</tr>
		</table>
		</body>
		</html>
		";
		$sql = "SELECT * FROM users WHERE email =  '". $_POST['email'] ."' or login = '" . $_POST['login']."'";
		$result = $con->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $con->error);
		}
		if ($result->num_rows === 0) {
			$hashed = hash('whirlpool', $_POST['passwd']);
			$sql = "INSERT INTO users (email, login, passwd, token) VALUES ('". ($_POST['email'])."','".$_POST['login']."', '$hashed' , '".substr(sha1(mt_rand()),17,6)."')";
			if ($con->query($sql) === TRUE) {
				echo "New record created successfully";
				mail($_POST['email'],"Confirm Email",$msg, $headers);
				header('Refresh: 0; URL=login.php');
			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}
			echo "OK\n";
		}else {

		}
	}
}
?>
<body>
	<div id="body_wrapper">
		<div id="wrapper">
			<div id="middle_subpage">
				<h2>Login</h2>
			</div>
			<div id="main"><span class="tm_top"></span>
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
					<div class="mid_box">
						<h1>Register</h1><br>
						<label for="email"><b>Email</b></label>
						<input type="email" placeholder="Enter Email" name="email" required>
						<br />
						<label for="login"><b>Username</b></label>
						<input type="text" placeholder="Enter Username" name="login" required>
						<br />
						<label for="passwd"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" name="passwd" required>
						<br />
						<label for="cpasswd"><b>Confirm</b></label>
						<input type="password" placeholder="Confirm Password" name="cpasswd" required>
						<button type="submit">Register</button>
					</div>
				</form>
				<div class="cleaner"></div>
				<div class="cleaner"></div>
				<div class="cleaner"></div>
			</div>
			<div id="tm_bottom"></div>
			<div id="footer">
				Copyright © 2018 <a href="#">WTC_Students</a>
			</div>
		</div>
		<div class="cleaner"></div>
	</div>
</body>
</html>
