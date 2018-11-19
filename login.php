<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style/style.css"/>
	<title>Login</title>
</head>
<?php
if(!isset($_SESSION))
{
	session_start();
}
require_once('auth.php');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	include('connect.php');
	$login = $_POST['email'];
	$passwd = $_POST['passwd'];
	if ($login && $passwd && auth($login, $passwd) == 1)
	{
		$sql = "SELECT login FROM users WHERE email = '" . $login ."'";
		$result = $con->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $con->error);
		}
		while($row = $result->fetch_assoc()) {
			$_SESSION['curr_user'] = $row["login"];
		}
		echo "Successfully Logged in\n" . $_SESSION['curr_user'];
		header("Location: index.php");
	}
	else if ($login && $passwd && auth($login, $passwd) == 2)
	{
		header("Location: token.php");
	}
	else
	{
		$_SESSION['curr_user'] = '';
	}
}
?>
<body>
	<?php
	include_once('header.php');
	?>
	<h2>Login</h2>
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
		Email : <input type="text" name="email" value="" id="email" required/><br />
		Password : <input type="password" name="passwd" id="passwd" value="" required/><br />
		<input type= "submit" name="submit" value="OK" id= "login"/>
	</form>
</body>
</html>
