<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tasks WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

$tasks = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode(['tasks' => $tasks]);
?>
