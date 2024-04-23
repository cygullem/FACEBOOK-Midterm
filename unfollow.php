<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$userEmail = $_SESSION['email'];
$friendId = $_POST['friendId']; 

$stmt = $pdo->prepare("DELETE FROM user_following WHERE follower_id = (SELECT id FROM login_table WHERE email = ?) AND followed_id = ?");
$stmt->execute([$userEmail, $friendId]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Unfollowed successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to unfollow']);
}
?>
