<!DOCTYPE html>

<html>
	<head>
		<title>Edit Product</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<?php 
		session_start();
		include 'initiate_db.php';
		$idedit=$_SESSION['cureditid'];
		$query="SELECT category FROM products WHERE idproducts = '".$idedit."' ";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		foreach($result as $row){
			$cureditcat = $row['category'];
		}
		$options = '';
		$query="SELECT DISTINCT category FROM categories where category != '".$cureditcat."' ";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$first = $cureditcat;
		$options .="<option>" . $first . "</option>";
		foreach($result as $row)
		{
			$options .="<option>" . $row['category'] . "</option>";
		}	
		$category="
						<p><label><b>Category</b></label></p>
						<select name='editcategory' id='editcategory'>
							" . $options . "
						</select>
					";		
		
		$query="SELECT * FROM products WHERE idproducts = '".$idedit."'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Edit Product</span>
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
			<?php foreach($result as $row){ ?>
			<div class="container productedit">
				<form action="/531Proj/input_handler.php" method="post">
					<b>Product Name:</b><br>
					<input type="text" name="editprodname" value=<?php echo $row['prodname'] ?>><br>
					<b>Product Price:</b><br>
					<input type="text" name="editprodprice" value=<?php echo $row['price'] ?>><br>
					<b>Stock:</b><br>
					<input type="text" name="editprodstock" value=<?php echo $row['stock'] ?>><br>
					<?php echo $category ?>
					<br>
					<b>Active:</b><br>
					<?php if ($row['status'] == "Yes"){ ?>
						<input type="radio" name="editstatus" value="Yes" checked="checked"> Yes
						<input type="radio" name="editstatus" value="No"> No
						<br>
						<br>
					<?php } ?>
					<?php if ($row['status'] == "No"){ ?>
						<input type="radio" name="editstatus" value="Yes"> Yes
						<input type="radio" name="editstatus" value="No" checked="checked"> No
						<br>
						<br>
					<?php } ?>
					<input type="submit" name="edit_update_submit" value="Submit">
				</form>
				<?php } ?>
				<br>
				<br>
				<a href="admin_products.html.php">Return to Product List</a>
				<br>
			</div>
		</div>
	</body>
</html>