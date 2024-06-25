<?php
require 'db_connect.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);

if ($stmt->execute()) {
    header("Location: ../login.html");
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}
?>
