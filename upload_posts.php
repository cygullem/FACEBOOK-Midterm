<?php
session_start();
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['email'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit();
    }

    $postId = $_POST['postId'];
    $editedCaption = $_POST['caption'];
    
    if (isset($_FILES['image'])) {
        $editedImage = $_FILES['image'];
    }

    $sql = "UPDATE post_table SET caption = ?";
    $params = [$editedCaption];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'Post_Images/' . $_FILES['image']['name'];

        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $sql .= ", imagePost = ?";
            $params[] = $imagePath;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
            exit();
        }
    }

    $sql .= " WHERE id = ?";
    $params[] = $postId;


    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $affectedRows = $stmt->rowCount();
    if ($affectedRows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Post updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update post']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
