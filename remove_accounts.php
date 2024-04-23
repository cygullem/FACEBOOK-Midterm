<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$userEmail = $_SESSION['email'];
$userId = $_POST['userId']; // Assuming you're sending userId via POST

$stmt = $pdo->prepare("DELETE FROM login_table WHERE id = ?");
$stmt->execute([$userId]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['status' => 'success', 'message' => 'User removed successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to remove user']);
}
?>
