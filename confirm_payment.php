<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$host = "sql308.ezyro.com";
$user = "ezyro_41212346";
$pass = "dantez4387";
$db   = "ezyro_41212346_dantez";

$conn = mysqli_connect($host, $user, $pass, $db);

$username = $_SESSION['username'];

$sql = "UPDATE users SET activated = 1 WHERE username='$username'";
mysqli_query($conn, $sql);

mysqli_close($conn);

$_SESSION['activated'] = 1;

echo "<div style='text-align:center;margin-top:100px;color:green;font-weight:bold;'>
🎉 Payment Received! Your account is now activated.
<br><br>
<a href='dashboard.php'>Go to Dashboard</a>
</div>";
?>