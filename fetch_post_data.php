<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if (!isset($_POST['postId'])) {
    echo json_encode(['status' => 'error', 'message' => 'Post ID not provided']);
    exit();
}

$postId = $_POST['postId'];
$email = $_SESSION['email'];

$stmt = $pdo->prepare("SELECT * FROM post_table WHERE id = ?");
$stmt->execute([$postId]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo json_encode(['status' => 'error', 'message' => 'Post not found']);
    exit();
}

echo json_encode($post);
?>
