<!DOCTYPE html>

<html>
	<head>
		<title> Analytics Table</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>	
	<body>
		<?php 
		session_start(); 
		include 'initiate_db.php';
		?>
		<div class="header-menu">
			<!-- start nav-bar -->
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Purchase Analytics: Table View</span>
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
			<div class="container anatable">
				<form action="/531Proj/admin_analyze_table.html.php" method="post">
				<?php
				$options = '';
				$query="SELECT username FROM users WHERE role = 'member' ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$first = "AllMembers";
				$options .="<option>" . $first . "</option>";
				foreach($result as $row)
				{
					$options .="<option>" . $row['username'] . "</option>";
				}	
				$members="
								<select name='useranalyze' id='useranalyze'>
									" . $options . "
								</select>
							";		
				?>
				<?php echo $members ?>
				<select name='type' id='type'>
					<option value="category">View Categories</option>
					<option value="product">View Products</option>
				</select>
				<select name='time' id='time'>
					<option value="all">All Time</option>
					<option value="week">Past Week</option>
					<option value="month">Past 30 Days</option>
					<option value="year">Past Year</option>
				</select>
				<input type="submit" name="table_analyze_submit" value="Submit">
				</form>
			</div>
			<?php
			if(isset($_POST['table_analyze_submit']))
			{
				$member = $_POST['useranalyze'];
				$type = $_POST['type'];
				$time = $_POST['time'];
				
				if($member == "AllMembers")
				{
					if($type == "product" && $time == "all")
					{ 
						
						$query = "SELECT item, COUNT(*) FROM purchases GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, All Time</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php } 
					
					if($type == "category" && $time == "all")
					{ 
						$query = "SELECT category, COUNT(*) FROM purchases GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, All Time</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "product" && $time == "week")
					{ 
						$query = "SELECT item, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 7 DAY) GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, Past Week</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "category" && $time == "week")
					{
						$query = "SELECT category, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 7 DAY) GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, Past Week</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "product" && $time == "month")
					{
						$query = "SELECT item, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 30 DAY) GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, Past 30 Days</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "category" && $time == "month")
					{
						$query = "SELECT category, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 30 DAY) GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, Past 30 Days</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "product" && $time == "year")
					{
						$query = "SELECT item, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 365 DAY) GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, Past Year</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "category" && $time == "year")
					{
						$query = "SELECT category, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 365 DAY) GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Members, Past Year</b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
				}else
				{
					if($type == "product" && $time == "all")
					{
						$query = "SELECT item, COUNT(*) FROM purchases WHERE customer = '".$member."' GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Time, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "category" && $time == "all")
					{
						$query = "SELECT category, COUNT(*) FROM purchases WHERE customer = '".$member."' GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>All Time, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "product" && $time == "week")
					{
						$query = "SELECT item, COUNT(*) FROM purchases WHERE customer = '".$member."' AND date > DATE_SUB(now(), INTERVAL 7 DAY) GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>Past Week, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "category" && $time == "week")
					{
						$query = "SELECT category, COUNT(*) FROM purchases WHERE customer = '".$member."' AND date > DATE_SUB(now(), INTERVAL 7 DAY) GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>Past Week, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "product" && $time == "month")
					{
						$query = "SELECT item, COUNT(*) FROM purchases WHERE customer = '".$member."' AND date > DATE_SUB(now(), INTERVAL 30 DAY) GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>Past 30 Days, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "category" && $time == "month")
					{
						$query = "SELECT category, COUNT(*) FROM purchases WHERE customer = '".$member."' AND date > DATE_SUB(now(), INTERVAL 30 DAY) GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>Past 30 Days, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "product" && $time == "year")
					{
						$query = "SELECT item, COUNT(*) FROM purchases WHERE customer = '".$member."' AND date > DATE_SUB(now(), INTERVAL 365 DAY) GROUP BY item ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>Past Year, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Item</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['item']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
					
					if($type == "category" && $time == "year")
					{
						$query = "SELECT category, COUNT(*) FROM purchases WHERE customer = '".$member."' AND date > DATE_SUB(now(), INTERVAL 365 DAY) GROUP BY category ";
						$stmt = $db->prepare($query);
						$stmt->execute();
						$result = $stmt->fetchAll();
						?>
						<u><b>Past Year, Member Name: <?php echo $member ?></b></u><br>
						<table class="prodtable">
							<thead>
								<tr>
									<th class="prodth"><b>Category</b></td>
									<th class="prodth"><b>Count</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="prodtd"><?php echo $row['category']?></td>
									<td class="prodtd"><?php echo $row['COUNT(*)']?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					<?php }
				}			
			}
			?>
		</div>
	</body>
</html>