<?php
header('Content-Type: application/json');
require_once '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$booking_id = $data['booking_id'] ?? null;

if (!$booking_id) {
    echo json_encode(['success' => false, 'message' => 'Booking ID is required.']);
    exit;
}

try {
    $check = $pdo->prepare("SELECT booking_id, status FROM bookings WHERE booking_id = ?");
    $check->execute([$booking_id]);
    $booking = $check->fetch(PDO::FETCH_ASSOC);

    if (!$booking) {
        echo json_encode(['success' => false, 'message' => 'Booking ID not found.']);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE bookings SET status = 'Cancelled' WHERE booking_id = ?");
    $stmt->execute([$booking_id]);

    echo json_encode(['success' => true, 'message' => 'Ticket cancelled successfully.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>