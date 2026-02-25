<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host = "sql308.ezyro.com";
    $user = "ezyro_41212346";
    $pass = "dantez4387";
    $db   = "ezyro_41212346_dantez";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Connection failed.");
    }

    $username   = mysqli_real_escape_string($conn, $_POST['username']);
    $gmail      = mysqli_real_escape_string($conn, $_POST['gmail']);
    $password   = mysqli_real_escape_string($conn, $_POST['password']);
    $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);

    if (empty($username) || empty($gmail) || empty($password) || empty($occupation)) {
        echo "<div style='color:red;font-weight:bold;text-align:center;margin-top:50px;'>
              ❌ Please fill all fields.
              </div>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, gmail, password, occupation)
            VALUES ('$username', '$gmail', '$hashed_password', '$occupation')";

    if (mysqli_query($conn, $sql)) {

        echo "<div style='color:green;font-weight:bold;text-align:center;margin-top:50px;font-size:20px;'>
              🎉 Registration Successful! Welcome to RemoteJobs.
              <br><br>
              <a href='login.html'>Go to Login →</a>
              </div>";

    } else {

        echo "<div style='color:red;font-weight:bold;text-align:center;margin-top:50px;'>
              ❌ Registration failed. Please try again.
              </div>";
    }

    mysqli_close($conn);
}
?>