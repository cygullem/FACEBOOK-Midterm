<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$email = $_SESSION['email'];

$stmt = $pdo->prepare("SELECT post_table.*, login_table.firstname, login_table.lastname, login_table.profile_picture 
                       FROM post_table 
                       INNER JOIN login_table ON post_table.user_id = login_table.id 
                       WHERE login_table.email = ?");
$stmt->execute([$email]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Modify the posts array to include the post ID
$postsWithId = array_map(function($post) {
    $post['id'] = (int)$post['id']; // Convert id to integer
    return $post;
}, $posts);

echo json_encode($postsWithId);
?>
