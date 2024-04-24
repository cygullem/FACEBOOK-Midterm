<?php
session_start();
include 'dbconnection.php';

if (!isset($_SESSION['email'])) {
    echo json_encode([]);
    exit();
}

$stmt = $pdo->query("SELECT * FROM login_table");
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($accounts);
?>
