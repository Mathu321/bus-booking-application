<?php
session_start();
header('Content-Type: application/json');
include '../db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$stmt = $pdo->query("
    SELECT b.*, bu.bus_name 
    FROM bookings b 
    JOIN buses bu ON b.bus_id = bu.bus_id 
    ORDER BY b.booking_id DESC
");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>