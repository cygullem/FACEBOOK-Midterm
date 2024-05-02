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

    if (!empty($_FILES['profilePicture']['name'])) {
        $imageName = uniqid() . '_' . basename($_FILES['profilePicture']['name']);
        $imagePath = 'ProfilePictures/' . $imageName;
        move_uploaded_file($_FILES['profilePicture']['tmp_name'], $imagePath);

        $stmt = $pdo->prepare("UPDATE login_table SET profile_picture = ? WHERE email = ?");
        $stmt->execute([$imagePath, $email]);

        if ($stmt->rowCount() > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Profile picture uploaded successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to upload profile picture';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No image uploaded';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
