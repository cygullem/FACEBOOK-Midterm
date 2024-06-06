<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = isset($_POST['post_id']) ? $_POST['post_id'] : null;
    $userId = $_SESSION['user_id'];

    if ($postId === null) {
        echo json_encode(['status' => 'error', 'message' => 'Missing post ID']);
        exit();
    }

    try {
        // Insert like into likes_table
        $stmt = $pdo->prepare("INSERT INTO likes_table (user_id, post_id) VALUES (?, ?)");
        $stmt->execute([$userId, $postId]);

        // Fetch the post owner
        $stmt = $pdo->prepare("SELECT user_id FROM post_table WHERE id = ?");
        $stmt->execute([$postId]);
        $postOwner = $stmt->fetch(PDO::FETCH_ASSOC)['user_id'];

        // Insert notification
        $stmt = $pdo->prepare("INSERT INTO notifications_table (sender_id, receiver_id, message, notification_time) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$userId, $postOwner, 'liked your post']);

        echo json_encode(['status' => 'success', 'message' => 'Post liked successfully']);
    } catch(PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to like post: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
