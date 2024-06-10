<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

try {
    $email = $_SESSION['email'];
    
    // Fetch user ID
    $stmt = $pdo->prepare("SELECT id FROM login_table WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit();
    }

    $userId = $user['id'];

    // Update notifications to read
    $stmt = $pdo->prepare("UPDATE notifications_table SET is_read = 1 WHERE user_id = ?");
    $stmt->execute([$userId]);

    echo json_encode(['status' => 'success']);
} catch(PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update notifications: ' . $e->getMessage()]);
}
?>
