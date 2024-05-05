<?php
include 'dbconnection.php';

if (!isset($_POST['post_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Post ID not provided']);
    exit();
}

$postId = $_POST['post_id'];

$stmt = $pdo->prepare("DELETE FROM post_table WHERE id = ?");
$stmt->execute([$postId]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Post deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete post']);
}
?>
