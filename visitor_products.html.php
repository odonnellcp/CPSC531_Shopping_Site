<!DOCTYPE html>

<html>
	<head>
		<title> Visitor Products</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		
		<?php session_start(); 
				include 'initiate_db.php';
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Visitor Products</span>
				</div>
				<div class="nav-right">
					<a class="nav-right-link" href="login.html.php">View Cart</a>
					<span class="line"></span> 
					<a href="login.html.php" class="nav-right-link">Log-In</a>
				</div>
			</div>
			<!-- end nav-bar -->
			<!-- start menu -->
			<div class="menu">
				<ul>
					<li><a href="index.html.php"><b>Homepage</b></a></li>
					<li class="active-menu"><a href="visitor_products.html.php"><b>View All Products</b></a></li>
				</ul>
			</div>
			<!-- end menu -->
		</div>
		<?php
		if(isset($_SESSION['curprodsearch']))
		{
			
			include 'prodsearchload.php';
			
		}else if( isset($_SESSION['curprodcat']))
		{
			
			include 'prodcatload.php';
		
		}else
		{
			
			include 'prodload.php';
		}		
		 
		
		?>
		<div class="content">
			<table class="prodtable center">
				<thead>
					<tr>
						<th class="prodth"><b>Name</b></th>
						<th class="prodth"><b>Price</b></th>
						<th class="prodth"><b>Stock</b></th>
						<th class="prodth"><b>Category</b></th>
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
							<td class="prodtd">
								<form action="/531Proj/visitor_products.html.php" method="post">
									<button type="submit" name="<?php echo $row['idproducts']?>" value="<?php echo $row['idproducts']?>">Add To Cart</button>
								</form>
							</td>
						</tr>
						<?php 
						if(isset($_POST[$row['idproducts']]))
						{
							header('Location:http://localhost/531Proj/login.html.php');
						
						}	
					}
					?>   
				</tbody>
			</table>
		</div>
	</body>
</html>