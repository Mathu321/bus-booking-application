<?php
session_start();
header('Content-Type: application/json');
include '../db.php';

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// Simple hardcoded check or check against a database admins table
if ($username === 'admin' && $password === 'admin123') {
    $_SESSION['admin_logged_in'] = true;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
}
?>