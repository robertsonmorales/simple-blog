<?php
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentId = $_POST['comment_id'];
    $comment = $conn->real_escape_string($_POST['comment']);

    $conn->query("UPDATE comments SET comment = '$comment' WHERE id = $commentId");

    echo "Comment updated successfully";
}
