<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_email = $_SESSION['email'];

// Fetch user details
$stmt_user = $pdo->prepare("SELECT id, firstname, lastname, profile_picture FROM login_table WHERE email = :email");
$stmt_user->execute([':email' => $user_email]);
$user_details = $stmt_user->fetch(PDO::FETCH_ASSOC);

$user_id = $user_details['id'];

// Fetch IDs of followed users
$stmt_followed = $pdo->prepare("SELECT followed_id FROM user_following WHERE follower_id = :follower_id");
$stmt_followed->execute([':follower_id' => $user_id]);
$followed_ids = $stmt_followed->fetchAll(PDO::FETCH_COLUMN);

if (empty($followed_ids)) {
    echo json_encode([]);
    exit();
}

// Prepare SQL query to fetch posts and check if they are liked by the current user
$sql = "SELECT post_table.*, 
               login_table.firstname AS user_firstname, 
               login_table.lastname AS user_lastname, 
               login_table.profile_picture AS user_profile_picture, 
               '{$user_details['firstname']}' AS session_firstname, 
               '{$user_details['lastname']}' AS session_lastname, 
               '{$user_details['profile_picture']}' AS session_profile_picture,
               (SELECT COUNT(*) FROM likes_table WHERE likes_table.post_id = post_table.id AND likes_table.user_id = ?) AS is_liked_by_user
        FROM post_table 
        INNER JOIN login_table ON post_table.user_id = login_table.id 
        WHERE post_table.user_id IN (";
$sql .= implode(',', array_fill(0, count($followed_ids), '?')) . ")";
$stmt_posts = $pdo->prepare($sql);

$params = array_merge([$user_id], $followed_ids);
foreach ($params as $key => $param) {
    $stmt_posts->bindValue($key + 1, $param);
}

$stmt_posts->execute();

$posts = $stmt_posts->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);
