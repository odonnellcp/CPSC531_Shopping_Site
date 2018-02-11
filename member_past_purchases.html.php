<!DOCTYPE html>

<html>
	<head>
	<title>Your Purchases</title>
	<link rel="stylesheet" href="./styles/styles.css">
	</head>	
	<body>
		<?php 
		session_start(); 
		include 'cartcount.php';
		$_SESSION['curprodsearch'] = null;	
		$_SESSION['curprodcat'] = null;	
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Past Purchases</span>
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
					<li><a href="member_products.html.php"><b>View All Products</b></a></li>
					<li class="active-menu"><a href="member_past_purchases.html.php"><b>View Past Purchases</b></a></li>
				</ul>
			</div>
			<!-- end menu -->
		</div>
		<div class="content">
			<?php
			$user = $_SESSION['user'];		
			$query = "SELECT * FROM purchases WHERE customer = '".$user."'  ORDER BY date DESC, price DESC ";
			$stmt = $db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll();
			?>
			<table class="prodtable center">
				<thead>
					<tr>
						<th class="prodth"><b>Product</b></th>
						<th class="prodth"><b>Price</b></th>
						<th class="prodth"><b>Date</b></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row){ ?>
						<tr>
							<td class="prodtd"><?php echo $row['item']?></td>
							<td class="prodtd"><?php echo $row['price']?></td>
							<td class="prodtd"><?php echo $row['date']?></td>
						</tr>
						<?php 
							
					}
					?>   
				</tbody>
			</table>
		</div>
	</body>
</html>