<?php
session_start();
header('Content-Type: application/json');
require_once '../config/db.php';

// Verify admin session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$username = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
    exit;
}

try {
    // Check if username already exists
    $check = $pdo->prepare("SELECT id FROM admins WHERE username = ?");
    $check->execute([$username]);
    if ($check->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Admin username already exists.']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed_password]);

    echo json_encode(['success' => true, 'message' => 'New admin created successfully.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>