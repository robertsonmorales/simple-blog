<?php
require '../config/database.php'; // Include your database connection file

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and verify the password
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;

            header('Location: ../index.php'); // Redirect to admin page
        } else {
            $_SESSION['logged_in'] = false;
            echo 'Invalid password';
        }
    } else {
        $_SESSION['logged_in'] = false;
        echo 'No user found with that username';
    }
    $stmt->close();
}
