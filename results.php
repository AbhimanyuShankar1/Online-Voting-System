<?php
include "config.php";
$result = mysqli_query($conn, "SELECT * FROM candidates ORDER BY votes DESC");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Voting Results</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Voting Results</h2>
        <table border="1" width="100%">
            <tr>
                <th>Candidate</th>
                <th>Party</th>
                <th>Votes</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['party'] ?></td>
                    <td><?= $row['votes'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>