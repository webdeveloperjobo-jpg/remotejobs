<?php
session_start();

/* ========= DATABASE CONNECTION ========= */
$host = "YOUR_DATABASE_HOST";
$db   = "YOUR_DATABASE_NAME";
$user = "YOUR_DATABASE_USER";
$pass = "YOUR_DATABASE_PASSWORD";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Service temporarily unavailable. Please try again later.");
}

/* ========= LOGIN LOGIC ========= */
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "⚠ Please enter both username and password.";
    } else {

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;

                header("Location: activate.php");
                exit();

            } else {
                $error = "❌ Login failed. Please check your details.";
            }

        } else {
            $error = "❌ Login failed. Please check your details.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body style="font-family: Arial; background:#f2f2f2; display:flex; justify-content:center; align-items:center; height:100vh;">

    <div style="background:white; padding:30px; width:350px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

        <h2 style="text-align:center;">Welcome Back 👋</h2>

        <?php if (!empty($error)) { ?>
            <div style="background:#ffe6e6; color:#cc0000; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center;">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <input type="text" name="username" placeholder="Username"
                style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px;" required>

            <input type="password" name="password" placeholder="Password"
                style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;" required>

            <button type="submit"
                style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px; cursor:pointer;">
                Login
            </button>

        </form>

        <p style="text-align:center; margin-top:15px;">
            Don't have an account?
            <a href="signup.php" style="color:#007bff;">Sign Up</a>
        </p>

    </div>

</body>
</html>
