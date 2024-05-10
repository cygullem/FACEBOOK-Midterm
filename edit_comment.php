<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $commentId = isset($_POST['editCommentId']) ? $_POST['editCommentId'] : null;
    $editedComment = isset($_POST['editComment']) ? $_POST['editComment'] : null;

    if ($loggedInUserId === null || $commentId === null || $editedComment === null) {
        echo json_encode(['status' => 'error', 'message' => 'Missing user ID, comment ID, or edited comment']);
        exit();
    }

    $stmt = $pdo->prepare("UPDATE comment_table SET comment = ? WHERE id = ? AND user_id = ?");
    $result = $stmt->execute([$editedComment, $commentId, $loggedInUserId]);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Comment successfully edited']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to edit comment']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
