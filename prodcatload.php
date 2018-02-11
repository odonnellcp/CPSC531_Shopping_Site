<?php

$curcat = $_SESSION['curprodcat'];
$query = "SELECT * FROM products WHERE stock > 0 AND category = '".$curcat."' AND status = 'Yes' ORDER BY category ASC, prodname ASC ";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>