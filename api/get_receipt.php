<?php
header('Content-Type: application/json');
include '../config/db.php';

$booking_id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("
    SELECT b.*, bu.bus_name, bu.source, bu.destination, bu.departure_time, bu.fare 
    FROM bookings b 
    JOIN buses bu ON b.bus_id = bu.bus_id 
    WHERE b.booking_id = ?
");
$stmt->execute([$booking_id]);
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

if ($booking) {
    echo json_encode(['success' => true, 'booking' => $booking]);
} else {
    echo json_encode(['success' => false, 'message' => 'Booking not found.']);
}
?>