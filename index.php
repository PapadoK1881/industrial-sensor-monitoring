<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Sensor Monitoring -Κωνσταντίνος Παπαδόπουλος</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Industrial Sensor Monitoring Dashboard</h1>

    <?php
    $sensors = $conn->query("SELECT COUNT(*) as total FROM sensors")->fetch_assoc()['total'];
    $measurements = $conn->query("SELECT COUNT(*) as total FROM measurements")->fetch_assoc()['total'];
    $alerts = $conn->query("SELECT COUNT(*) as total FROM alerts")->fetch_assoc()['total'];
    ?>

    <div class="nav">
        <a href="index.php">Dashboard</a>
        <a href="sensors.php">Sensors</a>
        <a href="measurements.php">Measurements</a>
        <a href="alerts.php">Alerts</a>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Total Sensors</h3>
            <p><?php echo $sensors; ?></p>
        </div>

        <div class="card">
            <h3>Total Measurements</h3>
            <p><?php echo $measurements; ?></p>
        </div>

        <div class="card">
            <h3>Total Alerts</h3>
            <p><?php echo $alerts; ?></p>
        </div>
    </div>

    <div class="panel">
        <h2>System Overview</h2>
        <p>
            This system monitors industrial sensors for temperature, humidity, and vibration
            in a digital industry environment.
        </p>
    </div>

</div>

<footer class="footer">
    <p>
        Κωνσταντίνος Παπαδόπουλος | ΑΜ: 23389115<br>
        6006 - Τεχνολογία Διαδικτύου στην Ψηφιακή Βιομηχανία<br>
        Τμήμα Μηχανικών Βιομηχανικής Σχεδίασης και Παραγωγής<br>
        Πανεπιστήμιο Δυτικής Αττικής
    </p>
</footer>
</body>
</html>
