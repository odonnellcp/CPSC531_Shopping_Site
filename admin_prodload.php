<?php
include 'initiate_db.php';

$query = "SELECT * FROM products ORDER BY category ASC, prodname ASC ";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>