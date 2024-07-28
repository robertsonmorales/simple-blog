<?php
require 'config/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postId = $_POST['post_id'];
        $username = $conn->real_escape_string($_POST['username']);
        $comment = $conn->real_escape_string($_POST['comment']);

        $conn->query("INSERT INTO comments (post_id, username, comment) VALUES ($postId, '$username', '$comment')");

        echo "Comment added successfully";
    }
} catch (\Throwable $th) {
    echo $th->getMessage();
}
