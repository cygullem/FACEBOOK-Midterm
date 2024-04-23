<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode([]);
    exit();
}

$userEmail = $_SESSION['email'];

// Fetch accounts the user is following
$stmt = $pdo->prepare("SELECT * FROM login_table WHERE id IN (SELECT followed_id FROM user_following WHERE follower_id = (SELECT id FROM login_table WHERE email = ?)) ORDER BY id DESC");
$stmt->execute([$userEmail]);
$followingAccounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($followingAccounts);
?>
