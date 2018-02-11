<?php
	session_start();
	include 'initiate_db.php';
	ob_start();
	$_SESSION['curprodsearch'] = null;	
	$_SESSION['curprodcat'] = null;	
	$user = $_SESSION['user'];
	$query = "SELECT prodname, price, count, idproducts FROM products, cart WHERE cart.cartuser = '".$user."' AND cart.prodid = products.idproducts ";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$cquery = "SELECT COUNT(*) FROM products, cart WHERE cart.cartuser = '".$user."' AND cart.prodid = products.idproducts ";
	$cstmt = $db->prepare($cquery);
	$cstmt->execute();
	$cresult = $cstmt->fetchAll();
?>
<html>
	<head>
	<title>Your Cart</title>
	<link rel="stylesheet" href="./styles/styles.css">
	</head>	
	<body>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Your Cart</span>
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
			<?php $totcost = 0; 
			foreach($cresult as $crow){
				if($crow['COUNT(*)'] == 0){
			?>
					<div class="container nocart"> <b>Your cart is currently empty!</b> </div>
		<?php }else{ ?>
					<br>
					<table class="prodtable">
						<thead>
							<tr>
								<th class="prodth"><b>Name</b></th>
								<th class="prodth"><b>Price</b></th>
								<th class="prodth"></th>
								<th class="prodth"><b>Amount</b></th>
								<th class="prodth"></th>
								<th class="prodth"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['prodname']?></td>
									<td class="prodtd">$<?php echo $row['price']?></td>
									<td class="prodtd">
										<form action="/531Proj/member_cart.html.php" method="post">
											<input type="submit" name="minus" value="-">
											<input type="hidden" name="idminus" value= "<?php echo $row['idproducts']?>">
										</form>
									</td>
									<td class="prodtd">
										<b><?php echo $row['count']?></b>
									</td>
									<td class="prodtd">
										<form action="/531Proj/member_cart.html.php" method="post">
											<input type="submit" name="plus" value="+">
											<input type="hidden" name="idplus" value= "<?php echo $row['idproducts']?>">
										</form>
									</td>
									<?php $totcost = $totcost + ($row['price'] * $row['count']); ?>
									<td class="prodtd">
										<form action="/531Proj/member_cart.html.php" method="post">
											<input type="submit" name="<?php echo $row['idproducts']?>" value="Remove from Cart">
										</form>
									</td>
								</tr>
								<?php 
								if(isset($_POST['plus']))
								{
									$prodid = $_POST['idplus'];
									$query = "SELECT stock FROM products WHERE idproducts = '".$prodid."' ";
									$stmt = $db->prepare($query);
									$stmt->execute();
									$result = $stmt->fetchAll();
									foreach($result as $row)
									{
										$curstock = $row['stock'];
									}
									$query = "SELECT count FROM cart WHERE cartuser = '".$_SESSION['user']."' AND prodid = '".$prodid."' ";
									$stmt = $db->prepare($query);
									$stmt->execute();
									$result = $stmt->fetchAll();
									foreach($result as $row)
									{
										$curcount = $row['count'];
									}
									
									if($curcount < $curstock){
										$query = "UPDATE cart SET Count = Count+1 WHERE cartuser = '".$_SESSION['user']."' AND prodid = '".$prodid."' ";
										$stmt = $db->prepare($query);
										$stmt->execute();
									}
									$_POST['plus'] = null;
									$_POST['idplus'] = null;
									header('Location:http://localhost/531Proj/member_cart.html.php');
								}else if(isset($_POST['minus']))
								{
									$prodid = $_POST['idminus'];
									$query = "SELECT count FROM cart WHERE cartuser = '".$_SESSION['user']."' AND prodid = '".$prodid."' ";
									$stmt = $db->prepare($query);
									$stmt->execute();
									$result = $stmt->fetchAll();
									foreach($result as $row)
									{
										$curcount = $row['count'];
									}
									if($curcount > 1){
										$query = "UPDATE cart SET Count = Count-1 WHERE cartuser = '".$_SESSION['user']."' AND prodid = '".$prodid."' ";
										$stmt = $db->prepare($query);
										$stmt->execute();
									}	
									$_POST['minus'] = null;
									$_POST['idminus'] = null;
									header('Location:http://localhost/531Proj/member_cart.html.php');
								}else if(isset($_POST[$row['idproducts']]))
								{
									$_SESSION['curdelid'] = $row['idproducts'];
									header('Location:http://localhost/531Proj/member_delete_cart.html.php');
								}
								
							}
							?>   
						</tbody>
					</table>
					<?php $_SESSION['totcost'] = $totcost; ?>
					<div class="container cartpurchase">
					<b>Total Cost: $<?php echo $totcost; ?></b>
					<br><br>
					<form action="/531Proj/input_handler.php" method="post">
						<button type="submit" class="button" name="cartpur" value="cartpur">Purchase Items</button>
					</form>
					</div>
		<?php }
			}
		?>
		</div>
	</body>
</html>

