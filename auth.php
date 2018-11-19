<?php
function auth($login, $passwd)
{
	include('connect.php');
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
				if ($row["confirmed"] == 0)
					return 2;
				else
					return 1;
		}
	}
	return 0;
}
?>
