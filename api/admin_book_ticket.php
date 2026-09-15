<?php
session_start();
header('Content-Type: application/json');
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$bus_id = $data['bus_id'] ?? null;
$passenger_name = trim($data['passenger_name'] ?? '');
$phone = trim($data['phone'] ?? '');
$seat_numbers = trim($data['seat_numbers'] ?? '');
$admin_username = $_SESSION['admin_username'] ?? 'admin';

if (!$bus_id || empty($passenger_name) || empty($phone) || empty($seat_numbers)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO bookings (bus_id, passenger_name, phone, seat_number, user_id, booked_by) VALUES (?, ?, ?, ?, NULL, ?)");
    $stmt->execute([$bus_id, $passenger_name, $phone, $seat_numbers, $admin_username]);
    $booking_id = $pdo->lastInsertId();

    echo json_encode(['success' => true, 'booking_id' => $booking_id, 'message' => 'Booking successful.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>