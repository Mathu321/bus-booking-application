<?php
session_start();
header('Content-Type: application/json');
include '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$bus_id = $data['bus_id'] ?? 0;

$stmt = $pdo->prepare("DELETE FROM buses WHERE bus_id = ?");
$success = $stmt->execute([$bus_id]);

echo json_encode(['success' => $success]);
?>