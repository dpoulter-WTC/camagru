<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>
	<link rel="stylesheet" href="style.css"/>
</head>
<?php
require_once('auth.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	function validate_form($p)
	{
		if ($p['login'] && $p['oldpw'] && $p['newpw'] && $p['submit'])
		if ($p['submit'] == 'OK')
		return true;
		return false;
	}
	function find_user($logins, $login, $oldhash)
	{
		foreach ($logins as $k => $v)
		if ($v['login'] == $login && $v['passwd'] == $oldhash)
		return $k;
		return false;
	}
	$file = '../private/passwd';
	$valid = validate_form($_POST);
	$logins = false;
	if (file_exists($file))
	$logins = unserialize(file_get_contents($file));
	if ($valid && $logins)
	{
		$oldhash = hash('whirlpool', $_POST['oldpw']);
		if (($user = find_user($logins, $_POST['login'], $oldhash)))
		{
			$logins[$user]['passwd'] = hash('whirlpool', $_POST['newpw']);
			file_put_contents($file, serialize($logins));
			echo "Successfully changed\n";
		}
		else { echo "ERROR\n"; }
	}
	else { echo "ERROR\n"; }
}
?>
<body>
	<div id="body_wrapper">
		<div id="wrapper">
			<?php include_once('header2.php');
			?>
			<div id="middle_subpage">
				<h2>Login</h2>
			</div>
			<div id="main"><span class="tm_top"></span>
				<form action="modify.php" method="POST">
					<div class="mid_box">
					Username: <input type="text" name="login" value="">
					<br />
					Old Password: <input type="text" name="oldpw" value="">
					<br />
					New Password: <input type="text" name="newpw" value="">
					<br />
					<input type="submit" name="submit" value="OK">
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
