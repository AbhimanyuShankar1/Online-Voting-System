<?php
session_start();
include "config.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM voters WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['voter_id'] = $user['voter_id'];
        header("Location: vote.php");
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Voter Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Voter Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="login">Login</button>
            <p>Not registered? <a href="register.php">Register here</a></p>
        </form>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</body>

</html>