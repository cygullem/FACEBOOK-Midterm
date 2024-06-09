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

$user_id = $user_details['id'];

$sql = "SELECT post_table.*, 
               login_table.firstname, 
               login_table.lastname, 
               login_table.profile_picture, 
               IF(likes_table.user_id IS NULL, 0, 1) AS is_liked_by_user 
        FROM post_table 
        INNER JOIN login_table ON post_table.user_id = login_table.id 
        LEFT JOIN likes_table ON likes_table.post_id = post_table.id AND likes_table.user_id = ? 
        WHERE post_table.user_id = ?";
$stmt_posts = $pdo->prepare($sql);

$stmt_posts->execute([$user_id, $user_id]);

$posts = $stmt_posts->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);
?>
