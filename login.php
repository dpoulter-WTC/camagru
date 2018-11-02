<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="style.css"/>
</head>
<?php
require_once('auth.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$con=mysqli_connect("localhost","camagru","password","camagru");
	$login = $_POST['email'];
	$passwd = $_POST['passwd'];
	if ($login && $passwd && auth($login, $passwd))
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
	else
	{
		$_SESSION['curr_user'] = '';
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$sql = "SELECT * FROM users WHERE email = '" . $login ."'";
		$result = $con->query($sql);
		if (!$result) {
			trigger_error('Invalid query: ' . $con->error);
		}
		if ($result->num_rows === 1) {
			while($row = $result->fetch_assoc()) {
				$hashed = hash('whirlpool', $passwd);
				if ($login == $row["email"] && $hashed == $row["passwd"])
				{
				}
				else {
					echo $login . '<br>' . $row["email"]. '<br>'. $hashed . '<br>' . $row["passwd"];
				}
			}
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
						Email : <input type="text" name="email" value="" required/><br />
						Password : <input type="password" name="passwd" value="" required/><br />
						<input type="submit" name="submit" value="OK"/>
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
