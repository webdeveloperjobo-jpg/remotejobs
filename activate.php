<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Account Activation</title>
<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    text-align:center;
    margin-top:100px;
}
.box{
    background:white;
    padding:40px;
    width:350px;
    margin:auto;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}
button{
    padding:10px 20px;
    background:#28a745;
    color:white;
    border:none;
    cursor:pointer;
    font-weight:bold;
}
</style>
</head>
<body>

<div class="box">
    <h2>Account Activation Required</h2>
    <p>You must pay <strong>KSh 60</strong> to activate your account.</p>
    <p><strong>Pay To:</strong> Student Business Organisation</p>

    <form action="confirm_payment.php" method="POST">
        <button type="submit">I Have Paid</button>
    </form>
</div>

</body>
</html>