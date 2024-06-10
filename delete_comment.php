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
        // Begin transaction
        $pdo->beginTransaction();

        // Delete the comment
        $stmt = $pdo->prepare("DELETE FROM comment_table WHERE id = ?");
        $stmt->bindParam(1, $commentId, PDO::PARAM_INT);
        $stmt->execute();

        // Check if the comment was deleted
        if ($stmt->rowCount() > 0) {
            // Delete the corresponding notification
            $stmtNotification = $pdo->prepare("DELETE FROM notifications_table WHERE reference_id = ? AND type = 'comment'");
            $stmtNotification->bindParam(1, $commentId, PDO::PARAM_INT);
            $stmtNotification->execute();

            // Logging for debugging
            if ($stmtNotification->rowCount() > 0) {
                error_log("Notification for comment_id $commentId deleted successfully.");
            } else {
                error_log("Notification for comment_id $commentId not found or already deleted.");
            }

            // Commit transaction
            $pdo->commit();

            echo json_encode(['status' => 'success', 'message' => 'Comment and its notification deleted successfully']);
        } else {
            // Rollback transaction
            $pdo->rollBack();

            echo json_encode(['status' => 'error', 'message' => 'Comment not found or already deleted']);
        }
    } catch(PDOException $e) {
        // Rollback transaction
        $pdo->rollBack();

        // Log the error
        error_log("Failed to delete comment: " . $e->getMessage());

        echo json_encode(['status' => 'error', 'message' => 'Failed to delete comment: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
