<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;

if ($post_id === null) {
    echo json_encode(['status' => 'error', 'message' => 'Missing post ID']);
    exit();
}

$stmt_user = $pdo->prepare("SELECT id, firstname, lastname FROM login_table WHERE email = ?");
$stmt_user->execute([$_SESSION['email']]);
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);
$loggedInUserId = $user['id'];

$stmt_comments = $pdo->prepare("
    SELECT comment_table.id, comment_table.comment, comment_table.comment_time, 
           login_table.firstname, login_table.lastname, login_table.profile_picture, 
           comment_table.user_id 
    FROM comment_table 
    JOIN login_table ON comment_table.user_id = login_table.id 
    WHERE comment_table.post_id = ?
    ORDER BY comment_table.comment_time DESC
");
$stmt_comments->execute([$post_id]);
$comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);

$stmt_post_owner = $pdo->prepare("
    SELECT login_table.firstname, login_table.lastname 
    FROM post_table 
    JOIN login_table ON post_table.user_id = login_table.id 
    WHERE post_table.id = ?
");
$stmt_post_owner->execute([$post_id]);
$post_owner = $stmt_post_owner->fetch(PDO::FETCH_ASSOC);

$response = [
    'comments' => $comments,
    'loggedInUserId' => $loggedInUserId,
    'ownerName' => $post_owner['firstname'] . ' ' . $post_owner['lastname']
];

echo json_encode($response);
?>
