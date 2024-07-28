<?php
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentId = $_POST['comment_id'];

    $conn->query("DELETE FROM comments WHERE id = $commentId");

    // echo "Comment deleted successfully";

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
