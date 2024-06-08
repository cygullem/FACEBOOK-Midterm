<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_email = $_SESSION['email'];

// Get the user ID from the session
$stmt_user = $pdo->prepare("SELECT id FROM login_table WHERE email = :email");
$stmt_user->execute([':email' => $user_email]);
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $user_id = $user['id'];
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
    exit();
}

// Check if post_id is provided
if (!isset($_POST['post_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Post ID not provided']);
    exit();
}

$post_id = $_POST['post_id'];

// Check if the post exists
$stmt_post = $pdo->prepare("SELECT user_id FROM post_table WHERE id = :post_id");
$stmt_post->execute([':post_id' => $post_id]);
$post = $stmt_post->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo json_encode(['status' => 'error', 'message' => 'Post not found']);
    exit();
}

// Insert the like into the likes_table
$stmt_like = $pdo->prepare("INSERT INTO likes_table (user_id, post_id) VALUES (:user_id, :post_id)");
$stmt_like->execute([':user_id' => $user_id, ':post_id' => $post_id]);

// Insert a notification into the notifications_table
$notification_message = "liked your post";
$notification_type = "like"; // or other appropriate type
$reference_id = $user_id; // assuming this is the ID of the user who liked the post

$stmt_notification = $pdo->prepare("
    INSERT INTO notifications_table (user_id, type, reference_id, message) 
    VALUES (:user_id, :type, :reference_id, :message)"
);
$stmt_notification->execute([
    ':user_id' => $post['user_id'], // The owner of the post
    ':type' => $notification_type,
    ':reference_id' => $reference_id,
    ':message' => $notification_message
]);

echo json_encode(['status' => 'success']);
?>
