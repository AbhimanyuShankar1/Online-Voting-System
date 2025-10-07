<?php
session_start();
include "../config.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Delete candidate
if (isset($_GET['delete'])) {
    $cid = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM candidates WHERE candidate_id=$cid");
    header("Location: dashboard.php?msg=Candidate Deleted");
}

$candidates = mysqli_query($conn, "SELECT * FROM candidates");
$results = mysqli_query($conn, "SELECT * FROM candidates ORDER BY votes DESC");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
</head>

<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome, <?= $_SESSION['admin'] ?> | <a href="logout.php">Logout</a></p>

        <h3>Manage Candidates</h3>
        <a href="add_candidate.php"><button>Add Candidate</button></a>
        <table border="1" width="100%">
            <tr>
                <th>Name</th>
                <th>Party</th>
                <th>Votes</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($candidates)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['party'] ?></td>
                    <td><?= $row['votes'] ?></td>
                    <td><a href="dashboard.php?delete=<?= $row['candidate_id'] ?>" onclick="return confirmDelete()">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

        <h3>Live Results</h3>
        <table border="1" width="100%">
            <tr>
                <th>Candidate</th>
                <th>Party</th>
                <th>Votes</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($results)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['party'] ?></td>
                    <td><?= $row['votes'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <script src="assets/script.js"></script>

</body>

</html>