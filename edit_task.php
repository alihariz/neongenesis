<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$task_id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];
$priority = $_POST['priority'];
$status = $_POST['status'];

$sql = "UPDATE tasks SET title = :title, description = :description, due_date = :due_date, priority = :priority, status = :status WHERE id = :id AND user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':due_date', $due_date);
$stmt->bindParam(':priority', $priority);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $task_id);
$stmt->bindParam(':user_id', $user_id);

if ($stmt->execute()) {
    header("Location: ../dashboard.html");
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
?>
