<?php require './config/database.php'; // Include database configuration
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php include 'includes/header.php'; ?>

        <div id="blog-posts">
            <!-- Blog posts will be loaded here dynamically using PHP -->
            <?php
            $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
            while ($row = $result->fetch_assoc()) { ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" onclick="showComments('<?= $row['id'] ?>')">View Comments</button>
                        <div id="comments-<?= $row['id'] ?>" class="comments mt-2"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Script -->
    <script>
        function showComments(postId) {
            $.ajax({
                url: 'comments.php',
                type: 'POST',
                data: {
                    post_id: postId
                },
                success: function(response) {
                    $('#comments-' + postId).html(response);
                }
            });
        }
    </script>
</body>

</html>