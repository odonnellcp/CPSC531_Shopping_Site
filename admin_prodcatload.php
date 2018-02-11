<?php
include 'initiate_db.php';

$curcat = $_SESSION['curprodcat'];
$query = "SELECT * FROM products WHERE category = '".$curcat."' ORDER BY category ASC, prodname ASC";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>