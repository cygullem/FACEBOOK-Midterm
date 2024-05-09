<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$stmt = $pdo->prepare("SELECT id FROM login_table WHERE email = ?");
$stmt->execute([$_SESSION['email']]);
$loggedInUserId = $stmt->fetchColumn();

$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;

if ($post_id === null) {
    echo json_encode(['status' => 'error', 'message' => 'Missing post ID']);
    exit();
}

$stmt = $pdo->prepare("SELECT login_table.firstname, login_table.lastname
                       FROM login_table
                       INNER JOIN post_table ON login_table.id = post_table.user_id
                       WHERE post_table.id = ?");
$stmt->execute([$post_id]);
$owner = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT comment_table.*, login_table.firstname, login_table.lastname, login_table.profile_picture
                       FROM comment_table
                       INNER JOIN login_table ON comment_table.user_id = login_table.id
                       WHERE comment_table.post_id = ?");
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($comments)) {
    echo json_encode(['status' => 'error', 'message' => 'No comments found for the post']);
    exit();
}

$response = [
    'status' => 'success',
    'ownerName' => $owner['firstname'] . ' ' . $owner['lastname'],
    'comments' => $comments,
    'loggedInUserId' => $loggedInUserId 
];

echo json_encode($response);
