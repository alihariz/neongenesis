<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$task_id = $_GET['id'];

$sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $task_id);
$stmt->bindParam(':user_id', $user_id);

if ($stmt->execute()) {
    header("Location: ../dashboard.html");
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
?>
