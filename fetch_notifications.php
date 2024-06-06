<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("
        SELECT notifications_table.*, 
               login_table.firstname, 
               login_table.lastname, 
               login_table.profile_picture 
        FROM notifications_table 
        JOIN login_table ON notifications_table.user_id = login_table.id 
        WHERE notifications_table.reference_id IN (SELECT id FROM post_table WHERE user_id = ?) 
        ORDER BY notifications_table.notification_time DESC
    ");
    $stmt->execute([$userId]);
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'notifications' => $notifications]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch notifications: ' . $e->getMessage()]);
}
?>
