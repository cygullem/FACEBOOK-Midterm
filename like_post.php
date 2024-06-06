<?php
session_start();
include 'dbconnection.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $postId = $_POST['post_id'];

        try {
            // Check if the user already liked the post
            $stmt = $pdo->prepare("SELECT * FROM likes_table WHERE user_id = ? AND post_id = ?");
            $stmt->execute([$userId, $postId]);
            $like = $stmt->fetch();

            if ($like) {
                // Unlike the post
                $stmt = $pdo->prepare("DELETE FROM likes_table WHERE user_id = ? AND post_id = ?");
                $stmt->execute([$userId, $postId]);
                $response['status'] = 'unliked';
            } else {
                // Like the post
                $stmt = $pdo->prepare("INSERT INTO likes_table (user_id, post_id) VALUES (?, ?)");
                $stmt->execute([$userId, $postId]);

                // Get post owner's ID
                $stmt = $pdo->prepare("SELECT user_id FROM post_table WHERE id = ?");
                $stmt->execute([$postId]);
                $postOwnerId = $stmt->fetchColumn();

                // Add a notification for the post owner
                if ($postOwnerId != $userId) {
                    $stmt = $pdo->prepare("
                        INSERT INTO notifications_table (user_id, type, reference_id, message) 
                        VALUES (?, 'like', ?, ?)
                    ");
                    $stmt->execute([$userId, $postId, 'liked your post']);
                }

                $response['status'] = 'liked';
            }

            $response['message'] = 'Operation successful';
        } catch (PDOException $e) {
            $response['status'] = 'error';
            $response['message'] = 'Failed to like/unlike post: ' . $e->getMessage();
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'User not logged in';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>
