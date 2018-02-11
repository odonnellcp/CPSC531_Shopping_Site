<!DOCTYPE html>
<html>
	<head>
		<title> Log-In</title>
		<link rel="stylesheet" href="./styles/styles.css">
	</head>
	<body>
		<div class="header-menu">
			<div class="nav-bar">
				<div class="nav-left">
					<span class="umhs">Online Shopping Site</span>
					<span class="line"></span> 
					<span class="page-label">Log-In</span>
				</div>
				<div class="nav-right">
					<a class="nav-right-link" href="index.html.php">Return to Homepage</a>
					<span class="line"></span> 
					<a class="nav-right-link" href="new_member.html.php">Register New Account</a>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container login">
				<form action="/531Proj/input_handler.php" method="post">
					<b>Username:</b><br>
					<input type="text" name="username"><br>
					<b>Password:</b><br>
					<input type="password" name="password" ><br><br>
					<input type="submit" name="login_submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html>