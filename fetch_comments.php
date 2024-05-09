<?php
session_start();
include 'dbconnection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Retrieve the post ID from the AJAX request
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;

// Check if the post ID is provided
if ($post_id === null) {
    echo json_encode(['status' => 'error', 'message' => 'Missing post ID']);
    exit();
}

// Fetch the owner's name for the specified post from the database
$stmt = $pdo->prepare("SELECT login_table.firstname, login_table.lastname
                       FROM login_table
                       INNER JOIN post_table ON login_table.id = post_table.user_id
                       WHERE post_table.id = ?");
$stmt->execute([$post_id]);
$owner = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch comments for the specified post from the database
$stmt = $pdo->prepare("SELECT comment_table.*, login_table.firstname, login_table.lastname, login_table.profile_picture
                       FROM comment_table
                       INNER JOIN login_table ON comment_table.user_id = login_table.id
                       WHERE comment_table.post_id = ?");
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if comments are found
if (empty($comments)) {
    echo json_encode(['status' => 'error', 'message' => 'No comments found for the post']);
    exit();
}

// Return the fetched comments along with the owner's name and post ID as JSON response
echo json_encode(['status' => 'success', 'ownerName' => $owner['firstname'] . ' ' . $owner['lastname'], 'comments' => $comments]);
?>
