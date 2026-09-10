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
    $stmt = $pdo->prepare("DELETE FROM bookings WHERE booking_id = ?");
    $stmt->execute([$booking_id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Ticket cancelled successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Booking ID not found.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>