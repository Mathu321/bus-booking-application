<?php
session_start();
header('Content-Type: application/json');
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode([]);
    exit;
}

$admin_username = $_SESSION['admin_username'] ?? '';

try {
    $stmt = $pdo->prepare("
        SELECT b.booking_id, b.passenger_name, b.phone, b.seat_number, bus.bus_name, bus.source, bus.destination, bus.departure_time 
        FROM bookings b 
        JOIN buses bus ON b.bus_id = bus.bus_id 
        WHERE b.booked_by = ? 
        ORDER BY b.booking_id DESC
    ");
    $stmt->execute([$admin_username]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($bookings);
} catch (PDOException $e) {
    echo json_encode([]);
}
?>