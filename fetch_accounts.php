<?php
include 'dbconnection.php';

$stmt = $pdo->query("SELECT * FROM login_table");
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($accounts);
?>
