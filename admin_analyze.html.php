<!DOCTYPE html>

<html>
	<head>
		<title>Analytics Homepage</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<?php 
		session_start(); 
		include 'initiate_db.php';
		$_SESSION['curprodsearch'] = null;	
		$_SESSION['curprodcat'] = null;	
		?>
		<?php
		$query = "SELECT * FROM purchases ORDER BY date DESC, idpurchases DESC ";
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
					<span class="page-label">Purchase Analytics: All Products</span>
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
					<li><a href="admin_products.html.php"><b>View All Products</b></a></li>
					<li class="active-menu"><a href="admin_analyze.html.php"><b>View Purchase Records</b></a></li>
				</ul>
			</div>
			<!-- end menu -->
		</div>
		<div class="content">
				<div class="container analyze">
					<table>
						<tbody>
							<td>
								<form action="/531Proj/input_handler.php" method="post">
									<button type="submit" class="button" name="tableview" value="tableview">Table View</button>
								</form>
							</td>
							<td>
								<form action="/531Proj/input_handler.php" method="post">
									<button type="submit" class="button" name="graphview" value="graphview">Graph View</button>
								</form>
							</td>
						</tbody>
					</table>
				</div>
			<table class="prodtable center">
				<thead>
					<tr>
						<th class="prodth"><b>Purchase ID</b></th>
						<th class="prodth"><b>Product</b></th>
						<th class="prodth"><b>Customer</b></th>
						<th class="prodth"><b>Price</b></th>
						<th class="prodth"><b>Date</b></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row){ ?>
						<tr>
							<td class="prodtd"><?php echo $row['idpurchases']?></td>
							<td class="prodtd"><?php echo $row['item']?></td>
							<td class="prodtd"><?php echo $row['customer']?></td>
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