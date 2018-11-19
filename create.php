<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create</title>
	<script src="create.js"></script>
</head>
<?php
include('connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ($_POST['login'] && $_POST['passwd'])
	{
		$pwd = $_POST['passwd'];
		if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $pwd)){
			$error = "Your password is too weak.";
			header('Refresh: 0; URL=create.php');
		}
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$code = substr(sha1(mt_rand()),17,6);
		$sql = "SELECT * FROM users WHERE token = '". $code ."'";
		$result = $con->query($sql);
		while ($result->num_rows !== 0)
		{
			$code = substr(sha1(mt_rand()),17,6);
			$sql = "SELECT * FROM users WHERE token = '". $code ."'";
			$result = $con->query($sql);
		}
		$up = dirname($_SERVER[REQUEST_URI]);
		$msg = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<p>This email contains HTML Tags!</p>
		<a href=http://$_SERVER[HTTP_HOST]$up/token.php?token=$code>Confirm</a>
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

			$sql = "INSERT INTO users (email, login, passwd, token) VALUES ('". ($_POST['email'])."','".$_POST['login']."', '$hashed' , '$code')";
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
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id = "form">
			<h1>Register</h1><br>
			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" id="email" required>
			<br />
			<label for="login"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="login" id="login" required>
			<br />
			<label for="passwd"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="passwd" id="passwd" required>
			<br />
			<label for="cpasswd"><b>Confirm</b></label>
			<input type="password" placeholder="Confirm Password" name="cpasswd" id="cpasswd" required>
			<button type=button id="register">Register</button>
	</form>
</body>
</html>
