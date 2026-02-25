<?php
session_start();

$host = "sql308.ezyro.com";
$user = "ezyro_41212346";
$pass = "dantez4387";
$db   = "ezyro_41212346_dantez";

$conn = mysqli_connect($host, $user, $pass, $db);

$login_input = trim($_POST['username']);
$password = trim($_POST['password']);

$sql = "SELECT * FROM users WHERE username='$login_input' OR gmail='$login_input'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {

    if (password_verify($password, $row['password'])) {

        $_SESSION['username'] = $row['username'];
        $_SESSION['activated'] = $row['activated'];

        if ($row['activated'] == 0) {
            header("Location: activate.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();

    } else {
        echo "Wrong password.";
    }

} else {
    echo "User not found.";
}

mysqli_close($conn);
?>