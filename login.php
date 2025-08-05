<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE role = ? AND username = ? AND password = ?");
    $stmt->bind_param("sss", $role, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        session_start();
        $_SESSION['role'] = $role;
        $_SESSION['username'] = $username;

        if ($role == 'user') {
            header("Location: user_dashboard.php");
        } else if ($role == 'admin') {
            header("Location: admin_dashboard.php");
        }
    } else {
        // Invalid login details
        echo "<script>alert('Invalid login details! Please try again.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $mysqli->close();
}
