<html>
<head>
	<title>Logout</title>
	<link rel="stylesheet" href="style/style.css"/>
</head>
<?php
if(!isset($_SESSION))
{
	session_start();
}
$_SESSION['curr_user'] = '';
?>
<html>
<body>
	<div id="body_wrapper">
		<div id="wrapper">
			<?php include_once('header.php');
			?>
			<div class="logout">
				<h1>Username changed. You are now logged out</h1>
			</div>
			<div id="tm_bottom"></div>
		</div>
		<div class="cleaner"></div>
	</div>
	<?php
	header('Refresh: 3; URL=index.php');
	?>
</body>
</html>
