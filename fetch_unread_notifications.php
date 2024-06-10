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

    // Fetch count of unread notifications
    $stmt = $pdo->prepare("SELECT COUNT(*) AS unread_count FROM notifications_table WHERE user_id = ? AND is_read = 0");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'unread_count' => $result['unread_count']]);
} catch(PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch notifications: ' . $e->getMessage()]);
}
?>
