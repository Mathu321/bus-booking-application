<?php
header('Content-Type: application/json');
include '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

$bus_id = $data['bus_id'] ?? null;
$passenger_name = $data['passenger_name'] ?? '';
$phone = $data['phone'] ?? '';
$seat_numbers = $data['seat_numbers'] ?? '';

if (!$bus_id || empty($passenger_name) || empty($phone) || empty($seat_numbers)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all details and select seats.']);
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO bookings (bus_id, passenger_name, phone, seat_number) VALUES (?, ?, ?, ?)");
    $stmt->execute([$bus_id, $passenger_name, $phone, $seat_numbers]);
    $booking_id = $pdo->lastInsertId();
    echo json_encode(['success' => true, 'booking_id' => $booking_id]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
}
?>