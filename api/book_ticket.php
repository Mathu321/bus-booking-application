<?php
session_start();
header('Content-Type: application/json');
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized. Please log in.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$bus_id = $data['bus_id'] ?? null;
$passenger_name = $data['passenger_name'] ?? '';
$phone = $data['phone'] ?? '';
$seat_numbers = $data['seat_numbers'] ?? '';
$user_id = $_SESSION['user_id'];

if (!$bus_id || empty($passenger_name) || empty($phone) || empty($seat_numbers)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO bookings (bus_id, user_id, passenger_name, phone, seat_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$bus_id, $user_id, $passenger_name, $phone, $seat_numbers]);
    $booking_id = $pdo->lastInsertId();

    echo json_encode(['success' => true, 'booking_id' => $booking_id]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>