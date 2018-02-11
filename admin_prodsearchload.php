<?php
include 'initiate_db.php';

$searchstring = $_SESSION['curprodsearch'];
$query = "SELECT * FROM products WHERE (`prodname` LIKE '%".$searchstring."%') ORDER BY category ASC, prodname ASC ";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>