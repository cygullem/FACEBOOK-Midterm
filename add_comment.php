<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$stmt_user = $pdo->prepare("SELECT id FROM login_table WHERE email = ?");
$stmt_user->execute([$_SESSION['email']]);
$user_id = $stmt_user->fetchColumn();

$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null; 
$comment = isset($_POST['comment']) ? $_POST['comment'] : null; 
$comment_time = date('Y-m-d H:i:s'); 

if ($post_id === null || $comment === null) {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    exit();
}

// Insert the comment into the comment_table
$stmt = $pdo->prepare("INSERT INTO comment_table (user_id, post_id, comment, comment_time) VALUES (?, ?, ?, ?)");
$result = $stmt->execute([$user_id, $post_id, $comment, $comment_time]);

if ($result) {
    // Get the post owner's user_id
    $stmt_post = $pdo->prepare("SELECT user_id FROM post_table WHERE id = ?");
    $stmt_post->execute([$post_id]);
    $post_owner_id = $stmt_post->fetchColumn();

    // Insert a notification into the notifications_table if the commenter is not the post owner
    if ($post_owner_id && $post_owner_id != $user_id) {
        $notification_message = "commented on your post";
        $notification_type = "comment";
        $reference_id = $user_id;

        $stmt_notification = $pdo->prepare("
            INSERT INTO notifications_table (user_id, type, reference_id, message, is_read) 
            VALUES (?, ?, ?, ?, 0)"
        );
        $stmt_notification->execute([$post_owner_id, $notification_type, $reference_id, $notification_message]);
    }

    echo json_encode(['status' => 'success', 'message' => 'Comment added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add comment']);
}
?>
