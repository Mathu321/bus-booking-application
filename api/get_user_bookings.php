<?php
session_start();
header('Content-Type: application/json');
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT b.booking_id, b.seat_number, b.passenger_name, b.phone, bu.bus_name, bu.source, bu.destination, bu.departure_time, bu.fare 
        FROM bookings b 
        JOIN buses bu ON b.bus_id = bu.bus_id 
        WHERE b.user_id = ?
        ORDER BY b.booking_id DESC
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'bookings' => $bookings]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>