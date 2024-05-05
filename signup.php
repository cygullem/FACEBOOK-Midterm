<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbconnection.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['username'];
    $password = $_POST['password'];

    $salt = random_bytes(16);

    $hexSalt = bin2hex($salt);

    $saltedPassword = $password . $salt;

    $hashedPassword = password_hash($saltedPassword, PASSWORD_DEFAULT);

    $defaultProfilePicture = './Assets/default-profilepicture.png';

    $stmt = $pdo->prepare("SELECT * FROM login_table WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Email already exists';
    } else {
        $stmt = $pdo->prepare("INSERT INTO login_table (firstname, lastname, email, password, salt, profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $email, $hashedPassword, $hexSalt, $defaultProfilePicture]);
        $response['status'] = 'success';
        $response['message'] = 'User created successfully';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
