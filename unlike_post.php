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

// Delete the like from the likes_table
$stmt_unlike = $pdo->prepare("DELETE FROM likes_table WHERE user_id = :user_id AND post_id = :post_id");
$stmt_unlike->execute([':user_id' => $user_id, ':post_id' => $post_id]);

// Delete the notification if the post is not owned by the user
if ($post['user_id'] != $user_id) {
    $stmt_delete_notification = $pdo->prepare("
        DELETE FROM notifications_table 
        WHERE user_id = :user_id 
        AND type = 'like' 
        AND reference_id = :reference_id 
        AND message = 'liked your post'
    ");
    $stmt_delete_notification->execute([
        ':user_id' => $post['user_id'], // The owner of the post
        ':reference_id' => $user_id // The user who liked the post
    ]);
}

echo json_encode(['status' => 'success']);
?>
