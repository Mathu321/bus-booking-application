<?php
header('Content-Type: application/json');
include '../config/db.php';

$source = $_GET['source'] ?? '';
$destination = $_GET['destination'] ?? '';

$query = "SELECT * FROM buses WHERE 1=1";
$params = [];

if (!empty($source)) {
    $query .= " AND source LIKE ?";
    $params[] = "%$source%";
}
if (!empty($destination)) {
    $query .= " AND destination LIKE ?";
    $params[] = "%$destination%";
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$buses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($buses);
?>