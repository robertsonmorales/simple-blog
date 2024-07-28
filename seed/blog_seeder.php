<?php
require '../config/database.php';

$title = 'My First Blog Post';
$content = 'This is my first blog post. You can find more information at http://example.com and http://example.com/blog';

$stmt = $conn->prepare("INSERT INTO posts (`title`, `content`) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content);
$stmt->execute();

echo "Blog created successfully.";

// header('Location: ../index.php');

$stmt->close();
