<!DOCTYPE html>

<html>
	<head>
		<title> Analytics Graphing</title>
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
					<span class="page-label">Purchase Analytics: Graph View</span>
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
			<div class="container anagraph">
				<form action="/531Proj/admin_analyze_graph.html.php" method="post">
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
				<input type="submit" name="graph_analyze_submit" value="Submit">
				</form>
			</div>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "product" && $_POST['time']== "all" ){
				$query = "SELECT item, COUNT(*) FROM purchases GROUP BY item ORDER BY COUNT(*) ASC, item ASC ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales All-Time by Product"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['item']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "category" && $_POST['time']== "all" ){
				$query = "SELECT category, COUNT(*) FROM purchases GROUP BY category ORDER BY COUNT(*) ASC, category ASC  ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales All-Time by Category"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['category']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "product" && $_POST['time']== "week" ){
				$query = "SELECT item, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 7 DAY) GROUP BY item ORDER BY COUNT(*) ASC, item ASC  ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales in Past Week by Product"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['item']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "category" && $_POST['time']== "week" ){
				$query = "SELECT category, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 7 DAY) GROUP BY category ORDER BY COUNT(*) ASC, category ASC ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales in Past Week by Category"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['category']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "product" && $_POST['time']== "month" ){
				$query = "SELECT item, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 30 DAY) GROUP BY item ORDER BY COUNT(*) ASC, item ASC  ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales in Past 30 Days by Product"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['item']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "category" && $_POST['time']== "month" ){
				$query = "SELECT category, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 30 DAY) GROUP BY category ORDER BY COUNT(*) ASC, category ASC  ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales in Past 30 Days by Category"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['category']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "product" && $_POST['time']== "year" ){
				$query = "SELECT item, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 365 DAY) GROUP BY item ORDER BY COUNT(*) ASC, item ASC ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales in Past Year by Product"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['item']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>
			<?php
			if(isset($_POST['graph_analyze_submit']) && $_POST['type']== "category" && $_POST['time']== "year" ){
				$query = "SELECT category, COUNT(*) FROM purchases WHERE date > DATE_SUB(now(), INTERVAL 365 DAY) GROUP BY category ORDER BY COUNT(*) ASC, category ASC ";
				$stmt = $db->prepare($query);
				$stmt->execute();
				$result = $stmt->fetchAll();
				?>
				<script src="canvasjs.min.js"></script>
				<script type="text/javascript">
		
				window.onload = function () {
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					animationDuration: 2000,
					title:{
						text: "Sales in Past Year by Category"              
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: [
							<?php foreach ($result as $row){ ?>
							{ label: "<?php echo $row['category']?>",  y: <?php echo $row['COUNT(*)']?>  },
							<?php }?>
						
						]
					}
					]
				});
				chart.render();
				}
				</script>
			
			<?php } ?>

			<div id="chartContainer" style="height: 300px; width: 100%;"></div>	
		</div>
	</body>
</html>