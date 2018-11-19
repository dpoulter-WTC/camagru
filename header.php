<div class="header">
	<div class = "left">
		<a href="index.php">
			<img src="resources/pages/Home.png" alt="" style="width:30px;height:30px;border:0;">
		</a>
	</div>
	<div class="right">
		<?php
		if(!isset($_SESSION))
		{
			session_start();
		}

		if ($_SESSION['curr_user'])
		{
			?>
			<a href="camera.php">Camera</a>
			<a href="my_index.php">My Photos</a>
			<a href="modify.php">Settings</a>
			<a href="logout.php">Log Out</a>
			<?php
	}
		else
		{
			echo '<a href="login.php">Login</a>
			<a href="create.php">Register</a>';
		}
		?>
		</div>
		<div class="clear"></div>
	</div>
</div>
