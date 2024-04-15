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
    
    if ($user) {
        // Retrieve salt from the database and convert it back to binary
        $storedSalt = hex2bin($user['salt']);
        
        // Concatenate salt with provided password
        $saltedPassword = $password . $storedSalt;
        
        // Hash the salted password
        $hashedPassword = password_hash($saltedPassword, PASSWORD_DEFAULT);
        
        // Verify hashed password
        if (password_verify($saltedPassword, $user['password'])) {
            $_SESSION['email'] = $email;
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
?>
