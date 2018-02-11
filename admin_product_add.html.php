<!DOCTYPE html>

<html>
	<head>
		<title> Add Product</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<?php 
		session_start();
		include 'initiate_db.php';
		$options = '';
		$query="SELECT DISTINCT category FROM categories";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row)
		{
			$options .="<option>" . $row['category'] . "</option>";
		}	
		$category="
						<p><label><b>Category</b></label></p>
						<select name='category' id='category'>
							" . $options . "
						</select>
					";		
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Add Product</span>
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
					<b>Product Name:</b><br>
					<input type="text" name="prodname"><br>
					<b>Product Price:</b><br>
					<input type="text" name="prodprice"><br>
					<b>Stock:</b><br>
					<input type="text" name="prodstock" ><br>
					<?php echo $category ?><br><br>
					<b>Active:</b><br>
					<input type="radio" name="status" value="Yes" checked="checked"> Yes
					<input type="radio" name="status" value="Yo"> No
					<br>
					<br>
					<input type="submit" name="prod_add_submit" value="Submit">
				</form>
				<br>
				<a href="category_add.html.php">Add a New Category</a>
				<br>
				<br>
				<a href="admin_products.html.php">Return to Product List</a>
				<br>
			</div>
		</div>
	</body>
</html>