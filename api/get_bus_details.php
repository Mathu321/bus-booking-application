<?php
header('Content-Type: application/json');
include '../config/db.php';

$bus_id = $_GET['bus_id'] ?? null;

if (!$bus_id) {
    echo json_encode(['bus' => null, 'booked_seats' => []]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM buses WHERE bus_id = ?");
    $stmt->execute([$bus_id]);
    $bus = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$bus) {
        echo json_encode(['bus' => null, 'booked_seats' => []]);
        exit;
    }

    // Only fetch seat numbers for active (non-cancelled) bookings
    $booked_stmt = $pdo->prepare("SELECT seat_number FROM bookings WHERE bus_id = ? AND status != 'Cancelled'");
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
} catch (PDOException $e) {
    echo json_encode(['bus' => null, 'booked_seats' => []]);
}
?>