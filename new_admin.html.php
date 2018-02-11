<!DOCTYPE html>
<html>
	<head>
		<title> Add New Admin</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<?php 
		session_start(); 
		$_SESSION['curprodsearch'] = null;	
		$_SESSION['curprodcat'] = null;	
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Register New Admin</span>
				</div>
				<div class="nav-right">
					<span class="page-label">Current User: <?php echo($_SESSION['user']); ?></span>
					<span class="line"></span> 
					<a class="nav-right-link" href="admin_homepage.html.php">Return to Homepage</a>
					<span class="line"></span> 
					<a href="index.html.php" class="nav-right-link">Log-Out</a>
				</div>
			</div>
			<!-- end nav-bar -->
		</div>
		<div class="content">
			<div class="container login">
				<form action="/531Proj/input_handler.php" method="post">
					Username:<br>
					<input type="text" name="newadmin"><br>
					Password:<br>
					<input type="text" name="newadminpass" ><br><br>
					<input type="submit" name="create_admin_submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html>