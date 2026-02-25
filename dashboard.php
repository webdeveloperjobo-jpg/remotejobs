<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

if ($_SESSION['activated'] == 0) {
    header("Location: activate.php");
    exit();
}
?>

<h2>Welcome <?php echo $_SESSION['username']; ?> 🎉</h2>
<p>Your account is fully activated.</p>