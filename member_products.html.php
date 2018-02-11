<!DOCTYPE html>

<html>
	<head>
	<title>Member Products</title>
	<link rel="stylesheet" href="./styles/styles.css">
	</head>	
	<body>
		<?php 
			session_start(); 
			include 'cartcount.php';
			ob_start();
			?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Member Products</span>
				</div>
				<div class="nav-right">
					<span class="page-label">Current User: <?php echo($_SESSION['user']); ?></span>
					<span class="line"></span> 
					<?php foreach($result as $row){ 
									$cartcount = $row['COUNT(*)'];
									if($cartcount > 0){					
									}else{
										$cartcount=0;
									}
					?>
					<a class="nav-right-link" href="member_cart.html.php">View Cart: <?php echo $cartcount ?></a>
					<?php } ?>
					<span class="line"></span> 
					<a href="index.html.php" class="nav-right-link">Log-Out</a>
				</div>
			</div>
			<!-- end nav-bar -->
			<!-- start menu -->
			<div class="menu">
				<ul>
					<li><a href="member_homepage.html.php"><b>Homepage</b></a></li>
					<li class="active-menu"><a href="member_products.html.php"><b>View All Products</b></a></li>
					<li><a href="member_past_purchases.html.php"><b>View Past Purchases</b></a></li>
				</ul>
			</div>
			<!-- end menu -->
		</div>
		<div class="content">
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
								<?php 
									$checkquery = "SELECT COUNT(*) FROM cart WHERE cartuser = '".$_SESSION['user']."' AND prodid = '".$row['idproducts']."'  ";
									$checkstmt = $db->prepare($checkquery);
									$checkstmt->execute();
									$checkresult = $checkstmt->fetchAll();
									
									foreach($checkresult as $checkrow){
										$count = $checkrow['COUNT(*)'];
										if($count > 0){	
								?>
											<b>Item in Cart</b>
								<?php
										}else{
								?>
											<form action="/531Proj/member_products.html.php" method="post">
												<button type="submit" name="<?php echo $row['idproducts']?>" value="<?php echo $row['idproducts']?>">Add To Cart</button>
											</form>
											
								<?php
										}
									}	
								?>
							</td>
						</tr>
						<?php 
						if(isset($_POST[$row['idproducts']]))
						{
							$prodid = $_POST[$row['idproducts']];
							echo $prodid;
							$query = "SELECT COUNT(*) FROM cart WHERE cartuser = '".$_SESSION['user']."' AND prodid = '".$prodid."' ";
							$stmt = $db->prepare($query);
							$stmt->execute();
							$result = $stmt->fetchAll();
							foreach($result as $row){
								if($row['COUNT(*)'] > 0)
								{
									$query = "UPDATE cart SET Count = Count+1 WHERE cartuser = '".$_SESSION['user']."' AND prodid = '".$prodid."' ";
									$stmt = $db->prepare($query);
									$stmt->execute();
								
									header('Location:http://localhost/531Proj/member_products.html.php');
								}else{
									$count = 1;
									$query = "INSERT INTO cart VALUES ('".$_SESSION['user']."', '".$prodid."', '".$count."')";
									$stmt = $db->prepare($query);
									$stmt->execute();
									header('Location:http://localhost/531Proj/member_products.html.php');
								}
							}
							
						}	
					}
					?>   
				</tbody>
			</table>
		</div>
	</body>
</html>