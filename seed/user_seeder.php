<?php
require '../config/database.php';

$name = 'John Doe';
$username = 'admin';
$password = password_hash('7ujm&UJM', PASSWORD_BCRYPT);
$isAdmin = true;

$stmt = $conn->prepare("INSERT INTO users (`name`, `username`, `password`, `is_admin`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssb", $name, $username, $password, $isAdmin);
$stmt->execute();

echo "User created successfully.";

// header('Location: ../index.php');

$stmt->close();
