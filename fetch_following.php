<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode([]);
    exit();
}

$userEmail = $_SESSION['email'];

// Fetch accounts the user is following
$stmt = $pdo->prepare("SELECT lt.firstname, lt.lastname, lt.profile_picture FROM login_table lt INNER JOIN user_following uf ON lt.id = uf.followed_id WHERE uf.follower_id = (SELECT id FROM login_table WHERE email = ?) ORDER BY lt.id DESC");
$stmt->execute([$userEmail]);
$followingAccounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($followingAccounts);
?>
