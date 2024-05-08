<?php
session_start();
include 'dbconnection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Retrieve the user's ID using their email
$stmt_user = $pdo->prepare("SELECT id FROM login_table WHERE email = ?");
$stmt_user->execute([$_SESSION['email']]);
$user_id = $stmt_user->fetchColumn();

// Sanitize and retrieve the input data
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null; // Assuming you are passing post_id via AJAX
$comment = isset($_POST['comment']) ? $_POST['comment'] : null; // Assuming you are passing comment via AJAX
$comment_time = date('Y-m-d H:i:s'); // Current timestamp

// Check if required parameters are provided
if ($post_id === null || $comment === null) {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    exit();
}

// Prepare and execute the SQL statement
$stmt = $pdo->prepare("INSERT INTO comment_table (user_id, post_id, comment, comment_time) VALUES (?, ?, ?, ?)");
$result = $stmt->execute([$user_id, $post_id, $comment, $comment_time]);

// Check if the comment was successfully inserted
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Comment added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add comment']);
}
