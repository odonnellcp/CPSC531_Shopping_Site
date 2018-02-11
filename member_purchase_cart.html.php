<?php
	session_start();
	include 'initiate_db.php';
?>
<html>
	<head>
	<title>Purchase Confirmation</title>
	<link rel="stylesheet" href="./styles/styles.css">
	</head>	
	<body>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Purchase Items</span>
				</div>
				<div class="nav-right">
					<span class="page-label">Current User: <?php echo($_SESSION['user']); ?></span>
					<span class="line"></span> 
					<a href="index.html.php" class="nav-right-link">Log-Out</a>
				</div>
			</div>
			<!-- end nav-bar -->
			<!-- start menu -->
			<div class="menu">
				<ul>
					<li><a href="member_homepage.html.php"><b>Homepage</b></a></li>
					<li ><a href="member_products.html.php"><b>View All Products</b></a></li>
					<li><a href="member_past_purchases.html.php"><b>View Past Purchases</b></a></li>
				</ul>
			</div>
			<!-- end menu -->
		</div>
		<div class="content">
			<div class="container cartbuyordel">
				Are you sure you want to purchase all of the products in your cart for  <b>$<?php echo $_SESSION['totcost'] ?></b>?
				<form action="/531Proj/input_handler.php" method="post">
					<input type="submit" name="purchase_yes_mem" value="Confirm">
					<input type="submit" name="purchase_no_mem" value="Cancel">
				</form>
			</div>
		</div>
	</body>
</html>