<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_email = $_SESSION['email'];

$stmt_user = $pdo->prepare("SELECT id FROM login_table WHERE email = :email");
$stmt_user->execute([':email' => $user_email]);
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $user_id = $user['id'];

    $stmt_notifications = $pdo->prepare("
        SELECT 
            n.*, 
            l.firstname AS liker_firstname, 
            l.lastname AS liker_lastname, 
            l.profile_picture AS liker_profile_picture 
        FROM 
            notifications_table n 
        INNER JOIN 
            login_table l 
        ON 
            n.reference_id = l.id 
        WHERE 
            n.user_id = :user_id 
        ORDER BY 
            n.notification_time DESC"
    );
    $stmt_notifications->execute([':user_id' => $user_id]);

    $notifications = $stmt_notifications->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'notifications' => $notifications]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}
?>
