<?php
include 'initiate_db.php';

$query =  "SELECT COUNT(*) FROM cart WHERE cartuser = '".$_SESSION['user']."' ";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

?>