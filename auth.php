<?php
function auth($login, $passwd)
{
	$con=mysqli_connect("localhost","camagru","password","camagru");
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
				return true;
		}
	}
	return false;
}
?>
