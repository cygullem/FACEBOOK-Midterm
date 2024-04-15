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

    // Generate a random salt
    $salt = random_bytes(16);

    // Convert salt to hexadecimal string for storage in the database
    $hexSalt = bin2hex($salt);

    // Append the salt to the password
    $saltedPassword = $password . $salt;

    // Hash the salted password
    $hashedPassword = password_hash($saltedPassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM login_table WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Email already exists';
    } else {
        $stmt = $pdo->prepare("INSERT INTO login_table (firstname, lastname, email, password, salt) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $email, $hashedPassword, $hexSalt]);
        $response['status'] = 'success';
        $response['message'] = 'User created successfully';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
