<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_email = $_SESSION['email'];

$stmt_user = $pdo->prepare("SELECT id, firstname, lastname, profile_picture FROM login_table WHERE email = :email");
$stmt_user->execute([':email' => $user_email]);
$user_details = $stmt_user->fetch(PDO::FETCH_ASSOC);

$stmt_followed = $pdo->prepare("SELECT followed_id FROM user_following WHERE follower_id = :follower_id");
$stmt_followed->execute([':follower_id' => $user_details['id']]);
$followed_ids = $stmt_followed->fetchAll(PDO::FETCH_COLUMN);

$sql = "SELECT post_table.*, 
               login_table.firstname AS user_firstname, 
               login_table.lastname AS user_lastname, 
               login_table.profile_picture AS user_profile_picture, 
               '{$user_details['firstname']}' AS session_firstname, 
               '{$user_details['lastname']}' AS session_lastname, 
               '{$user_details['profile_picture']}' AS session_profile_picture 
        FROM post_table 
        INNER JOIN login_table ON post_table.user_id = login_table.id 
        WHERE post_table.user_id IN (";
$sql .= implode(',', array_fill(0, count($followed_ids), '?')) . ")";
$stmt_posts = $pdo->prepare($sql);

foreach ($followed_ids as $key => $id) {
    $stmt_posts->bindValue($key + 1, $id);
}

$stmt_posts->execute();

$posts = $stmt_posts->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);
