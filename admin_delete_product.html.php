<?php
	session_start();
	include 'initiate_db.php';
	$iddelete=$_SESSION['curdelid'];
	$query = "SELECT prodname, idproducts FROM products WHERE idproducts = '".$iddelete."' ";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
?>
<html>
	<head>
	<title> Deletion Confirmation</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Delete Product</span>
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
		</div>
		<div class="content">
			<div class="container cartbuyordel">
			<?php foreach($result as $row){ ?>
			You want to delete the product <?php echo $row['prodname'] ?> with the ID of <?php echo $row['idproducts'] ?>?
			<?php } ?>
			<form action="/531Proj/input_handler.php" method="post">
				<input type="submit" name="delete_yes" value="Confirm">
				<input type="submit" name="delete_no" value="Cancel">
			</form>
			</div>
		</div>
	</body>
</html>