<?php include 'db.php'; ?>

<?php
if (isset($_POST['add_measurement'])) {

    $sensor_id = $_POST['sensor_id'];
    $value = $_POST['value'];
    $unit = $_POST['unit'];
    $recorded_at = date("Y-m-d H:i:s");
    $condition_status = "Normal";

    if ($unit == "C" && $value > 80) {
        $condition_status = "Alert";
    }

    if ($unit == "%" && $value > 65) {
        $condition_status = "Alert";
    }

    if ($unit == "mm/s" && $value > 5) {
        $condition_status = "Alert";
    }

    $sql = "INSERT INTO measurements (sensor_id, value, unit, recorded_at, condition_status)
            VALUES ('$sensor_id', '$value', '$unit', '$recorded_at', '$condition_status')";

    $conn->query($sql);

    if ($condition_status == "Alert") {
        $sensor_result = $conn->query("SELECT name FROM sensors WHERE id = '$sensor_id'");
        $sensor = $sensor_result->fetch_assoc();
        $sensor_name = $sensor['name'];

        $message = "Threshold exceeded for sensor: " . $sensor_name;
        $alert_level = "High";

        $conn->query("INSERT INTO alerts (sensor_id, message, alert_level, created_at)
                      VALUES ('$sensor_id', '$message', '$alert_level', '$recorded_at')");
    }

    header("Location: measurements.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Measurements -Κωνσταντίνος Παπαδόπουλος</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Measurements</h1>

    <div class="nav">
        <a href="index.php">Dashboard</a>
        <a href="sensors.php">Sensors</a>
        <a href="measurements.php">Measurements</a>
        <a href="alerts.php">Alerts</a>
    </div>

    <div class="panel">
        <h2>Add Measurement</h2>

        <form method="POST" class="form-box">

            <label>Sensor</label>
            <select name="sensor_id" required>
                <?php
                $sensors = $conn->query("SELECT * FROM sensors ORDER BY name ASC");
                while ($s = $sensors->fetch_assoc()) {
                    echo "<option value='" . $s['id'] . "'>" . $s['name'] . "</option>";
                }
                ?>
            </select>

            <label>Value</label>
            <input type="number" step="0.01" name="value" required>

            <label>Unit</label>
            <select name="unit">
                <option value="C">C</option>
                <option value="%">%</option>
                <option value="mm/s">mm/s</option>
            </select>

            <button type="submit" name="add_measurement">Add Measurement</button>
        </form>
    </div>

    <div class="panel">
        <h2>Measurement List</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Sensor</th>
                <th>Value</th>
                <th>Unit</th>
                <th>Date</th>
                <th>Status</th>
            </tr>

            <?php
            $query = "SELECT measurements.*, sensors.name
                      FROM measurements
                      JOIN sensors ON sensors.id = measurements.sensor_id
                      ORDER BY measurements.id DESC";

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['value'] . "</td>
                        <td>" . $row['unit'] . "</td>
                        <td>" . $row['recorded_at'] . "</td>
                        <td>" . $row['condition_status'] . "</td>
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
