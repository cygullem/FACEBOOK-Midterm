<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;

    if ($commentId === null) {
        echo json_encode(['status' => 'error', 'message' => 'Missing comment ID']);
        exit();
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM comment_table WHERE id = ?");
        $stmt->bindParam(1, $commentId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Comment deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Comment not found or already deleted']);
        }
    } catch(PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete comment: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
