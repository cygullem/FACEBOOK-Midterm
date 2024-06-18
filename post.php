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
    $filesArray = [];

    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $imageName = $_FILES["images"]["name"][$key];
            $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
            $newImageName = uniqid() . '.' . $imageExtension;

            $imagePath = 'Post_Images/' . $newImageName;
            move_uploaded_file($tmpName, $imagePath);
            $filesArray[] = $newImageName;
        }
    }

    $filesJson = json_encode($filesArray);

    $stmt = $pdo->prepare("SELECT id FROM login_table WHERE email = ?");
    $stmt->execute([$email]);
    $userId = $stmt->fetchColumn();

    if ($userId) {
        $stmt = $pdo->prepare("INSERT INTO post_table (user_id, caption, imagePost) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $caption, $filesJson]);

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
?>
