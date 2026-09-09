<?php
header('Content-Type: application/json');
include '../db.php';

$bus_id = $_GET['bus_id'] ?? 1;

$stmt = $pdo->prepare("SELECT * FROM buses WHERE bus_id = ?");
$stmt->execute([$bus_id]);
$bus = $stmt->fetch(PDO::FETCH_ASSOC);

$booked_stmt = $pdo->prepare("SELECT seat_number FROM bookings WHERE bus_id = ?");
$booked_stmt->execute([$bus_id]);
$raw_booked = $booked_stmt->fetchAll(PDO::FETCH_COLUMN);

$booked_seats = [];
foreach ($raw_booked as $item) {
    foreach (explode(',', $item) as $s) {
        $booked_seats[] = trim($s);
    }
}

echo json_encode([
    'bus' => $bus,
    'booked_seats' => $booked_seats
]);
?>