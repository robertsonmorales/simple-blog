<header class="d-flex align-items-center justify-content-between my-4">
    <h4>Blog.</h4>
    <div>
        <?php if (isset($_SESSION['logged_in'])) { ?>
            <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['username'] ?>" alt="User" width="42" height="42" class="rounded-circle mr-2" />
            <a href="auth/logout.php">Log out</a>
        <?php } else { ?>
            <a href="auth/login_form.php">Log in</a>

        <?php } ?>
    </div>
</header>