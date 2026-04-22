<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerts -Κωνσταντίνος Παπαδόπουλος</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Alerts</h1>

    <div class="nav">
        <a href="index.php">Dashboard</a>
        <a href="sensors.php">Sensors</a>
        <a href="measurements.php">Measurements</a>
        <a href="alerts.php">Alerts</a>
    </div>

    <div class="panel">
        <h2>System Alerts</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Sensor</th>
                <th>Message</th>
                <th>Level</th>
                <th>Date</th>
            </tr>

            <?php
            $query = "SELECT alerts.*, sensors.name
                      FROM alerts
                      JOIN sensors ON sensors.id = alerts.sensor_id
                      ORDER BY alerts.id DESC";

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['message'] . "</td>
                        <td>" . $row['alert_level'] . "</td>
                        <td>" . $row['created_at'] . "</td>
                      </tr>";
            }
            ?>
        </table>
    </div>

</div>
<footer class="footer">
    <strong>Κωνσταντίνος Παπαδόπουλος</strong> | ΑΜ: 23389115<br><br>

    6006 - Τεχνολογία Διαδικτύου στην Ψηφιακή Βιομηχανία<br>
    Τμήμα Μηχανικών Βιομηχανικής Σχεδίασης και Παραγωγής<br>
    Πανεπιστήμιο Δυτικής Αττικής
</footer>
</body>
</html>
