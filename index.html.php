<!DOCTYPE html>

<html>
	<head>
	<title> Visitor Homepage</title>
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
					<span class="page-label">Visitor Homepage</span>
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
					<li class="active-menu"><a href="index.html.php"><b>Homepage</b></a></li>
					<li ><a href="visitor_products.html.php"><b>View All Products</b></a></li>
				</ul>
			</div>
			<!-- end menu -->
		</div>
		<div class="content">
			<div class="container">
				<form action="/531Proj/index.html.php" method="post">
					Search for Products:<br>
					<input type="text" name="prod_lookup">			
					<input type="submit" name="prod_search" value="Submit">
				</form>
				<?php include 'catload.php'; ?>
					<table class="cattable">
					<thead>
						<tr>
							<th class="catth"><b>Categories</b></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($result as $row){ ?>
							<tr>
								<td class="cattd">
									<form action="/531Proj/index.html.php" method="post">
										<button type="submit" class="button" name="<?php echo $row['category']?>" value="<?php echo $row['category']?>"><?php echo $row['category']?></button>
									</form>
								</td>
							</tr>
							<?php 
							if(isset($_POST[$row['category']]))
							{
								$_SESSION['curprodcat'] = $_POST[$row['category']];
								header('Location:http://localhost/531Proj/visitor_products.html.php');
							}
						
							if(isset($_POST['prod_search']) && isset($_POST['prod_lookup']))
							{
								$_SESSION['curprodsearch'] = $_POST['prod_lookup'];
								header('Location:http://localhost/531Proj/visitor_products.html.php');
							}
						}
						?>   
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>