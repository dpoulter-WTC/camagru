<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
	<title>Password reset</title>
</head>
<?php
include("connect.php");
require_once('auth.php');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	include('connect.php');
	$login = $_POST['email'];
	$sql = "SELECT login FROM users WHERE email = '" . $login ."'";
	$result = $con->query($sql);
	if($result->num_rows === 1)
	{
		$pass = substr(sha1(mt_rand()),17,6);
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$msg = "
		<html>
		<head>
		<title>Reset</title>
		</head>
		<body>
		<p>Hello</p>
		</br>
		<p>Your new Password is:".$pass."</p>
		</body>
		</html>
		";
		$hashed = hash('whirlpool', $pass);
		$sql = "UPDATE users SET passwd = '".$hashed."' WHERE email = '" . $login ."'";
		$result = $con->query($sql);
		$success = mail($_POST['email'],"Confirm Email",$msg, $headers);
		if (!$success) {
			$errorMessage = error_get_last()['message'];
		} else {
			header('Refresh: 0; URL=login.php');
		}
	}
}
?>
<body>
	<?php
	include_once('header.php');
	?>
	<div class = "create">
	<h2>Login</h2>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
		Email : <input type="text" name="email" value="" id="email" required/><br />
		<button id="submit">Reset password</button>
	</form>
</div>
</body>
</html>
