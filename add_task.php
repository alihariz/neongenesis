<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];
$priority = $_POST['priority'];
$status = $_POST['status'];

$sql = "INSERT INTO tasks (user_id, title, description, due_date, priority, status) VALUES (:user_id, :title, :description, :due_date, :priority, :status)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':due_date', $due_date);
$stmt->bindParam(':priority', $priority);
$stmt->bindParam(':status', $status);

if ($stmt->execute()) {
    header("Location: ../dashboard.html");
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
?>
