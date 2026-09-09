<?php
session_start();
header('Content-Type: application/json');
include '../db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$bus_id = $data['bus_id'] ?? null;
$bus_name = $data['bus_name'] ?? '';
$source = $data['source'] ?? '';
$destination = $data['destination'] ?? '';
$departure_time = $data['departure_time'] ?? '';
$total_seats = $data['total_seats'] ?? 40;
$fare = $data['fare'] ?? 0;

if ($bus_id) {
    // Update existing bus
    $stmt = $pdo->prepare("UPDATE buses SET bus_name=?, source=?, destination=?, departure_time=?, total_seats=?, fare=? WHERE bus_id=?");
    $success = $stmt->execute([$bus_name, $source, $destination, $departure_time, $total_seats, $fare, $bus_id]);
} else {
    // Insert new bus
    $stmt = $pdo->prepare("INSERT INTO buses (bus_name, source, destination, departure_time, total_seats, fare) VALUES (?, ?, ?, ?, ?, ?)");
    $success = $stmt->execute([$bus_name, $source, $destination, $departure_time, $total_seats, $fare]);
}

echo json_encode(['success' => $success]);
?>