<?php
session_start();
include 'dbconnection.php';

$response = array();

if (!isset($_SESSION['email'])) {
    $response['status'] = 'error';
    $response['message'] = 'User not logged in';
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $caption = $_POST['post_text'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $imagePath = 'Post_Images/' . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = null;
    }

    $stmt = $pdo->prepare("SELECT id FROM login_table WHERE email = ?");
    $stmt->execute([$email]);
    $userId = $stmt->fetchColumn();

    if ($userId) {
        $stmt = $pdo->prepare("INSERT INTO post_table (user_id, caption, imagePost) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $caption, $imagePath]);

        if ($stmt->rowCount() > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Post created successfully';
            header("Location: mainpage.php");
            exit();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to create post';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'User not found';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
