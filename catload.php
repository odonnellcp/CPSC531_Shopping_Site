<?php
include 'initiate_db.php';

$query = "SELECT DISTINCT category FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>