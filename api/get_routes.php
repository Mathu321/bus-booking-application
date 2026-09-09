<?php
header('Content-Type: application/json');
include '../config/db.php';

$stmt = $pdo->query("SELECT DISTINCT source, destination, MIN(fare) as min_fare FROM buses GROUP BY source, destination");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>