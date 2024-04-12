<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbconnection.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];

    $stmt = $pdo->prepare("SELECT * FROM login_table WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['email'] = $email;
        $response['status'] = 'success';
        $response['message'] = 'Login successful';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid email or password';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
