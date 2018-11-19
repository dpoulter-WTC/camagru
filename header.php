<div class="header">
	<div class = "left">
		<a href="page_index.php">
			<img src="resources/pages/Home.png" alt="" style="width:30px;height:30px;border:0;">
		</a>
	</div>
	<div class="right">
		<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if ($_SESSION['logged_on_user'])
		{
			?>
			<div class= "left">
				<div class="dropdown">
					<?php
					echo '<button class="dropbtn">'.$_SESSION['logged_on_user'].'</button>';
					?>
					<div class="dropdown-content">
						<a href="page_modif.php">Modify</a>
						<a href="logout.php">Log out</a>
					</div>
				</div>
			</div>
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
