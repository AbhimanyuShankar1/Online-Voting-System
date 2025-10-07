<?php
session_start();
include "config.php";

if (!isset($_SESSION['voter_id'])) {
    header("Location: index.php");
    exit();
}

$voter_id = $_SESSION['voter_id'];

// check if already voted
$check = mysqli_query($conn, "SELECT has_voted FROM voters WHERE voter_id=$voter_id");
$row = mysqli_fetch_assoc($check);

if ($row['has_voted'] == 1) {
    echo "<div class='container'><h2>You have already voted!</h2><a href='results.php'>View Results</a></div>";
    exit();
}

// submit vote
if (isset($_POST['candidate'])) {
    $candidate_id = $_POST['candidate'];

    mysqli_query($conn, "INSERT INTO votes (voter_id, candidate_id) VALUES ($voter_id, $candidate_id)");
    mysqli_query($conn, "UPDATE candidates SET votes = votes + 1 WHERE candidate_id=$candidate_id");
    mysqli_query($conn, "UPDATE voters SET has_voted = 1 WHERE voter_id=$voter_id");

    echo "<div class='container'><h2>Your vote has been recorded!</h2><a href='results.php'>View Results</a></div>";
    exit();
}

$candidates = mysqli_query($conn, "SELECT * FROM candidates");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Vote Now</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Vote for Your Candidate</h2>
        <form method="POST">
            <?php while ($row = mysqli_fetch_assoc($candidates)) { ?>
                <input type="radio" name="candidate" value="<?= $row['candidate_id'] ?>" required>
                <?= $row['name'] ?> (<?= $row['party'] ?>)<br>
            <?php } ?>
            <button type="submit">Submit Vote</button>
        </form>
    </div>
    <script src="assets/script.js"></script>

</body>

</html>