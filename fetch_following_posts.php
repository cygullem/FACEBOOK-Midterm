<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Retrieve the IDs of the accounts that the current user follows
$user_email = $_SESSION['email'];
$stmt = $pdo->prepare("SELECT followed_id FROM user_following WHERE follower_id = (SELECT id FROM login_table WHERE email = ?)");
$stmt->execute([$user_email]);
$followed_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Query the posts of the accounts that the current user follows
$stmt = $pdo->prepare("SELECT post_table.*, login_table.firstname, login_table.lastname, login_table.profile_picture 
                       FROM post_table 
                       INNER JOIN login_table ON post_table.user_id = login_table.id 
                       WHERE post_table.user_id IN (".implode(',', array_fill(0, count($followed_ids), '?')).")");
$stmt->execute($followed_ids);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);
?>
