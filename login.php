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

    // Assuming this is part of your login script
    if ($user) {
        $storedSalt = hex2bin($user['salt']);
        $saltedPassword = $password . $storedSalt;
        $hashedPassword = password_hash($saltedPassword, PASSWORD_DEFAULT);

        if (password_verify($saltedPassword, $user['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user['id']; // Add this line to set the user ID in the session
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid email or password';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid email or password';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
