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

$stmt = $pdo->prepare("INSERT INTO comment_table (user_id, post_id, comment, comment_time) VALUES (?, ?, ?, ?)");
$result = $stmt->execute([$user_id, $post_id, $comment, $comment_time]);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Comment added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add comment']);
}
