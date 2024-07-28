<?php
require 'config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postId = $_POST['post_id'];

    $result = $conn->query("SELECT * FROM comments WHERE post_id = $postId ORDER BY created_at DESC");

    while ($row = $result->fetch_assoc()) { ?>
        <div class="card card-<?= $row['id'] ?> mt-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name=<?= htmlspecialchars($row['username']) ?>" alt="Public User" width="42" height="42" class="rounded-circle mr-3" />
                        <div>
                            <h6 class="card-subtitle"><?= htmlspecialchars($row['username']) ?></h6>
                            <p class="m-0 text-muted">
                                <?php
                                $dateTime = new DateTime($row['created_at']);
                                echo $dateTime->format('F d, Y h:i A'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="actions">
                        <?php if (isset($_SESSION['logged_in'])) {
                            $comment = $row["comment"];
                            $username = $row["username"];
                            $id = $row["id"]; ?>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary mr-2" onclick="editCard(<?= $id; ?>, '<?php echo $username; ?>', '<?php echo trim(addslashes($comment)); ?>' )">Edit</button>
                                <button class="btn btn-danger" onclick="removeCard(<?= $row['id'] ?>)">Remove</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="m-0"><?= nl2br(htmlspecialchars($row['comment'])) ?></h5>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Add comment form for public users -->
    <div class="mt-4">
        <h5>Add a Comment</h5>
        <form id="comment-form-<?= $postId ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= @$_SESSION['username'] ?? '' ?>" required <?= @$_SESSION['username'] ? 'readonly' : '' ?>>
            </div>
            <input type="hidden" name="comment_id" id="comment_id" value="">
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <input type="hidden" name="post_id" value="<?= $postId ?>">
            <button type="button" id="btn-submit" class="btn btn-primary" data-mode="create" onclick="submitComment('<?= $postId ?>')">Submit</button>
        </form>
    </div>
<?php } ?>

<script>
    function editCard(id, username, comment) {
        $('#username').val(username).attr('required', false);
        $('#comment').val(comment);
        $('#comment_id').val(id);
        $('#btn-submit').text('Updated Changes').data('mode', 'update');
    }

    function removeCard(id) {
        // Add your remove functionality here
        if (confirm('Are you sure you want to remove this comment?')) {
            $.ajax({
                url: 'admin/admin_delete_comment.php',
                type: 'POST',
                data: {
                    comment_id: id
                },
                success: function(response) {
                    document.querySelector(`.card-${id}`).remove();
                    alert('Comment removed successfully');
                }
            });
        }
    }

    function submitComment(postId) {
        let isUpdate = $('#btn-submit').data('mode') == 'update';
        let form = $(`#comment-form-${postId}`);
        let isUsernameSet;
        let isCommentSet;

        if (!isUpdate) {
            if ($('#username').val() == '') {
                alert('Please enter your username');
                isUsernameSet = false;
                return;
            } else {
                isUsernameSet = true;
            }
        } else {
            isUsernameSet = true;
        }

        if ($('#comment').val() == '') {
            alert('Please enter your comment');
            isCommentSet = false;
            return;
        } else {
            isCommentSet = true;
        }

        if (isUsernameSet && isCommentSet) {
            let url = isUpdate ? 'admin/admin_edit_comment.php' : 'submit_comment.php';

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    showComments(postId);
                }
            });
        }
    }
</script>