<?php
session_start();
include "../config.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $party = $_POST['party'];

    $sql = "INSERT INTO candidates (name, party) VALUES ('$name','$party')";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?msg=Candidate Added Successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Candidate</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Add New Candidate</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Candidate Name" required>
            <input type="text" name="party" placeholder="Party Name" required>
            <button type="submit" name="add">Add Candidate</button>
        </form>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>

</html>