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

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM login_table WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Email already exists';
    } else {
        $stmt = $pdo->prepare("INSERT INTO login_table (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
        $response['status'] = 'success';
        $response['message'] = 'User created successfully';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
