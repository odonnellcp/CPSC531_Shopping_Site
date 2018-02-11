<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
include 'initiate_db.php';



if(isset($_POST['login_submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query = "SELECT COUNT(*), username, password, role FROM (SELECT username, password, role FROM users WHERE username = '".$username."' && password = '".$password."') AS x";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	foreach ($result as $row){ 
		if($row['COUNT(*)'] > 0)
			
		{
			if($row['role'] == "Admin")
			{
				$_SESSION['user'] = $username;
				header('Location:http://localhost/531Proj/admin_homepage.html.php');
			 }elseif($row['role'] == "Member"){
				 $_SESSION['user'] = $username;
				 $_SESSION['cartnum'] = 0;
				 $cartarr = array();
				 $_SESSION['cartarr'] = $cartarr;
				header('Location:http://localhost/531Proj/member_homepage.html.php');
			 }
		} else{
			header('Location:http://localhost/531Proj/index.html.php');
		}
	}
}

if(isset($_POST['create_member_submit']))
{
	$newmember=$_POST['newmember'];
	$newmempass=$_POST['newmempass'];
	$query = "INSERT INTO users VALUES ('".$newmember."', '".$newmempass."', 'Member')";
	$stmt = $db->prepare($query);
	$stmt->execute();
	header('Location:http://localhost/531Proj/index.html.php');
}

if(isset($_POST['create_admin_submit']))
{
	$newadmin=$_POST['newadmin'];
	$newadminpass=$_POST['newadminpass'];
	$query = "INSERT INTO users VALUES ('".$newadmin."', '".$newadminpass."', 'Admin')";
	$stmt = $db->prepare($query);
	$stmt->execute();
	header('Location:http://localhost/531Proj/admin_homepage.html.php');
}

if(isset($_POST['prod_add_submit']) && isset($_POST['prodname']) && isset($_POST['prodprice']) && isset($_POST['prodstock']) && isset($_POST['status']))
{
	$prodname=$_POST['prodname'];
	$prodprice=floatval($_POST['prodprice']);
	$prodstock=$_POST['prodstock'];
	$prodcat=$_POST['category'];
	$prodstatus=$_POST['status'];
	$query = "INSERT INTO products VALUES (default, '".$prodname."', '".$prodprice."', '".$prodstock."', '".$prodcat."', '".$prodstatus."')";
	$stmt = $db->prepare($query);
	$stmt->execute();
	header('Location:http://localhost/531Proj/admin_products.html.php');
}

if(isset($_POST['cat_add_submit']) && isset($_POST['catname']))
{
	$catname=$_POST['catname'];
	$query = "INSERT INTO categories VALUES ('".$catname."')";
	$stmt = $db->prepare($query);
	$stmt->execute();
	header('Location:http://localhost/531Proj/admin_product_add.html.php');
}

if(isset($_POST['purchase_yes']))
{
	$idproducts=$_SESSION['curpurid'];
	
	$query = "SELECT prodname, price FROM products WHERE idproducts = '".$idproducts."' ";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	foreach($result as $row)
	{
		$item = $row['prodname'];
		$customer = $_SESSION['user'];
		$price = $row['price'];
		$date = date("Y-m-d H:i:s");
		
	}
	
	$query = "INSERT INTO purchases VALUES (default, '".$item."', '".$customer."', '".$price."', '".$date."')";
	$stmt = $db->prepare($query);
	$stmt->execute();
	
	$query = "UPDATE products SET stock = stock - 1 WHERE idproducts = '".$idproducts."' and stock > 0";
	$stmt = $db->prepare($query);
	$stmt->execute();
	
	header('Location:http://localhost/531Proj/member_products.html.php');
}

if(isset($_POST['purchase_no']))
{
	$_SESSION['curpurid'] = null;
	header('Location:http://localhost/531Proj/member_products.html.php');
}

if(isset($_POST['delete_yes']))
{
	$iddelete=$_SESSION['curdelid'];
	
	$query = "DELETE FROM products WHERE idproducts = '".$iddelete."' ";
	$stmt = $db->prepare($query);
	$stmt->execute();
	
	
	header('Location:http://localhost/531Proj/admin_products.html.php');
}

if(isset($_POST['delete_no']))
{
	$_SESSION['curdelrid'] = null;
	header('Location:http://localhost/531Proj/admin_products.html.php');
}

if(isset($_POST['edit_yes']))
{
	header('Location:http://localhost/531Proj/admin_active_edit.html.php');
}

if(isset($_POST['edit_no']))
{
	$_SESSION['cureditid'] = null;
	header('Location:http://localhost/531Proj/admin_products.html.php');
}

if(isset($_POST['edit_update_submit']) && isset($_POST['editprodname']) && isset($_POST['editprodprice']) && isset($_POST['editprodstock']))
{
	$idedit=$_SESSION['cureditid'];
	$editprodname=$_POST['editprodname'];
	$editprodprice=floatval($_POST['editprodprice']);
	$editprodstock=$_POST['editprodstock'];
	$editprodcat=$_POST['editcategory'];
	$editprodstatus=$_POST['editstatus'];
	$query = "UPDATE products SET prodname = '".$editprodname."', price = '".$editprodprice."', stock = '".$editprodstock."', category = '".$editprodcat."', status = '".$editprodstatus."' WHERE idproducts = '".$idedit."' ";
	$stmt = $db->prepare($query);
	$stmt->execute();
	header('Location:http://localhost/531Proj/admin_products.html.php');
}

if(isset($_POST['delete_yes_mem']))
{
	$user = $_SESSION['user'];
	$iddelete=$_SESSION['curdelid'];
	
	$query = "DELETE FROM cart WHERE cartuser = '".$user."' AND prodid = '".$iddelete."' ";
	$stmt = $db->prepare($query);
	$stmt->execute();
	
	header('Location:http://localhost/531Proj/member_cart.html.php');
}

if(isset($_POST['delete_no_mem']))
{
	$_SESSION['curdelrid'] = null;
	header('Location:http://localhost/531Proj/member_cart.html.php');
}

if(isset($_POST['purchase_yes_mem']))
{
	$user = $_SESSION['user'];
	
	$query = "SELECT prodid, count FROM cart WHERE cartuser = '".$user."' ";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	foreach($result as $row)
	{
		$purchasecount = $row['count'];
		for($i = 0; $i < $purchasecount; $i++)
		{
			$idproducts=$row['prodid'];
			$purquery = "SELECT prodname, price, category FROM products WHERE idproducts = '".$idproducts."' ";
			$purstmt = $db->prepare($purquery);
			$purstmt->execute();
			$purResult = $purstmt->fetchAll();
			
			foreach($purResult as $purRow)
			{
				$item = $purRow['prodname'];
				$cat = $purRow['category'];
				$customer = $_SESSION['user'];
				$price = $purRow['price'];
				$date = date("Y-m-d H:i:s");
			}
			$purquery = "INSERT INTO purchases VALUES (default, '".$item."', '".$cat."', '".$customer."', '".$price."', '".$date."')";
			$purstmt = $db->prepare($purquery);
			$purstmt->execute();
	
			$purquery = "UPDATE products SET stock = stock - 1 WHERE idproducts = '".$idproducts."' and stock > 0";
			$purstmt = $db->prepare($purquery);
			$purstmt->execute();
		}	
		
		$query = "DELETE FROM cart WHERE cartuser = '".$user."' AND prodid = '".$row['prodid']."' ";
		$stmt = $db->prepare($query);
		$stmt->execute();
		
	}
	
	header('Location:http://localhost/531Proj/member_products.html.php');
}

if(isset($_POST['purchase_no_mem']))
{
	header('Location:http://localhost/531Proj/member_cart.html.php');
}

if(isset($_POST['graphview']))
{
	header('Location:http://localhost/531Proj/admin_analyze_graph.html.php');
}
if(isset($_POST['tableview']))
{
	header('Location:http://localhost/531Proj/admin_analyze_table.html.php');
}
if(isset($_POST['cartpur']))
{
	header('Location:http://localhost/531Proj/member_purchase_cart.html.php');
}
?>