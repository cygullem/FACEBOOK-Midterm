<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if (!isset($_POST['postId'])) {
    echo json_encode(['status' => 'error', 'message' => 'Post ID not provided']);
    exit();
}

$postId = $_POST['postId'];
$email = $_SESSION['email'];

// Fetch existing post data
$stmt = $pdo->prepare("SELECT * FROM post_table WHERE id = ?");
$stmt->execute([$postId]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo json_encode(['status' => 'error', 'message' => 'Post not found']);
    exit();
}

$caption = $_POST['editCaption'];

// Update caption
$stmt = $pdo->prepare("UPDATE post_table SET caption = ? WHERE id = ?");
$stmt->execute([$caption, $postId]);

// Handle image deletion
$imagesToDelete = isset($_POST['imagesToDelete']) ? json_decode($_POST['imagesToDelete'], true) : [];
$existingImages = json_decode($post['imagePost'], true);
$updatedImages = array_diff($existingImages, $imagesToDelete);

// Handle new images upload
$newImages = [];
if (!empty($_FILES['editImage']['name'][0])) {
    $total = count($_FILES['editImage']['name']);
    for ($i = 0; $i < $total; $i++) {
        $tmpFilePath = $_FILES['editImage']['tmp_name'][$i];
        if ($tmpFilePath != ""){
            $newFilePath = "Post_Images/" . basename($_FILES['editImage']['name'][$i]);
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $newImages[] = basename($_FILES['editImage']['name'][$i]);
            }
        }
    }
}

// Merge existing and new images
$allImages = array_merge($updatedImages, $newImages);

// Update images in the database
$stmt = $pdo->prepare("UPDATE post_table SET imagePost = ? WHERE id = ?");
$stmt->execute([json_encode($allImages), $postId]);

echo json_encode(['status' => 'success', 'message' => 'Post updated successfully']);
?>
