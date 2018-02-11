<!DOCTYPE html>

<html>
	<head>
	<title> Admin Products</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<?php 
			session_start();
			ob_start();
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Admin Products</span>
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
			<?php 
			if(isset($_SESSION['curprodsearch']))
			{
				include 'admin_prodsearchload.php';
			}else if( isset($_SESSION['curprodcat']))
			{			
				include 'admin_prodcatload.php';
			}else
			{			
				include 'admin_prodload.php';
			}	
			?>
			<div class="container adminprod">
			<form  action="/531Proj/admin_products.html.php" method="post">
				<button type="submit"  class="button" name="add_prod_link" value="add_prod_link">Add Products</button>
			</form>
			</div>
			<table class="prodtable center">
				<thead>
					<tr>
						<th class="prodth"><b>Name</b></th>
						<th class="prodth"><b>Price</b></th>
						<th class="prodth"><b>Stock</b></th>
						<th class="prodth"><b>Category</b></th>
						<th class="prodth"><b>Active?</b></th>
						<th class="prodth"></th>
						<th class="prodth"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row){ ?>
						<tr>
							<td class="prodtd"><?php echo $row['prodname']?></td>
							<td class="prodtd">$<?php echo $row['price']?></td>
							<td class="prodtd"><?php echo $row['stock']?></td>
							<td class="prodtd"><?php echo $row['category']?></td>
							<td class="prodtd"><?php echo $row['status']?></td>
							<td class="prodtd">
								<form action="/531Proj/admin_products.html.php" method="post">
									<input type="submit" name="<?php echo $row['idproducts']?>" value="Delete">
								</form>
							</td>
							<td class="prodtd">
								<form action="/531Proj/admin_products.html.php" method="get">
									<input type="submit" name="<?php echo $row['idproducts']?>" value="Edit">
								</form>
							</td>
						</tr>
					<?php
					if(isset($_POST[$row['idproducts']]))
						{
							$_SESSION['curdelid'] = $row['idproducts'];
							header('Location:http://localhost/531Proj/admin_delete_product.html.php');
						}	
				
					if(isset($_GET[$row['idproducts']]))
						{
							$_SESSION['cureditid'] = $row['idproducts'];
							header('Location:http://localhost/531Proj/admin_edit_product.html.php');
						}	
					}
					?>   
				</tbody>
			</table>
			<br>
			
			<?php 
			if(isset($_POST['add_prod_link']))
			{ 
				$newprod = "yes";
				header('Location: http://localhost/531Proj/admin_product_add.html.php');
			} ?>
			<br>
		<div>
	</body>
</html>