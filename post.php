<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];

    if (isset($_POST['caption']) && isset($_POST['imageData'])) {
        $caption = $_POST['caption'];
        $imageData = $_POST['imageData'];

        // Check if the post_table has columns named user_id, caption, and image_post
        $stmt = $pdo->prepare("INSERT INTO post_table (user_id, caption, image_post) VALUES ((SELECT id FROM login_table WHERE email = ?), ?, ?)");
        $stmt->execute([$email, $caption, $imageData]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Post created successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create post']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing caption or imageData']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
