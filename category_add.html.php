<!DOCTYPE html>

<html>
	<head>
		<title> Add Category</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<?php 
		session_start();
		include 'initiate_db.php';
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Add New Category</span>
				</div>
				<div class="nav-right">
					<span class="page-label">Current User: <?php echo($_SESSION['user']); ?></span>
					<span class="line"></span> 
					<a class="nav-right-link" href="new_admin.html.php">Register New Admin</a>
					<span class="line"></span> 
					<a href="login.html.php" class="nav-right-link">Log-Out</a>
				</div>
			</div>
			<!-- end nav-bar -->
			<!-- start menu -->
			<div class="menu">
				<ul>
					<li><a href="admin_homepage.html.php"><b>Homepage</b></a></li>
					<li class="active-menu"><a href="admin_products.html.php"><b>View All Products</b></a></li>
					<li><a href="admin_analyze.html.php"><b>View Purchase Records</b></a></li>
				</ul>
			</div>
			<!-- end menu -->
		</div>
		<div class="content">
			<div class="container productedit">
				<form action="/531Proj/input_handler.php" method="post">
					Category Name:<br>
					<input type="text" name="catname"><br><br>
					<input type="submit" name="cat_add_submit" value="Submit">
				</form>
				<br>
				<a href="admin_product_add.html.php">Return to Product Add Screen</a>
				<br>
			</div>
		</div>
	</body>
</html>