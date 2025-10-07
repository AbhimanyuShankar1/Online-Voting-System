<?php
include "config.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO voters (name, email, password) VALUES ('$name','$email','$password')";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Registration successful! <a href='index.php'>Login now</a></p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Voter Registration</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Enter Full Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>

</html>