<?php

$searchstring = $_SESSION['curprodsearch'];
$query = "SELECT * FROM products WHERE (`prodname` LIKE '%".$searchstring."%') AND stock > 0 AND status = 'Yes' ORDER BY category ASC, prodname ASC ";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>