<?php include 'db.php'; ?>

<?php
if (isset($_POST['add_sensor'])) {

    $name = $_POST['name'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $status = $_POST['status'];

    $sql = "INSERT INTO sensors (name, type, location, status)
            VALUES ('$name', '$type', '$location', '$status')";

    $conn->query($sql);
    header("Location: sensors.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensors -Κωνσταντίνος Παπαδόπουλος</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Sensors</h1>

    <div class="nav">
        <a href="index.php">Dashboard</a>
        <a href="sensors.php">Sensors</a>
        <a href="measurements.php">Measurements</a>
        <a href="alerts.php">Alerts</a>
    </div>

    <div class="panel">
        <h2>Add New Sensor</h2>

        <form method="POST" class="form-box">
            <label>Name</label>
            <input type="text" name="name" required>

            <label>Type</label>
            <select name="type">
                <option value="Temperature">Temperature</option>
                <option value="Humidity">Humidity</option>
                <option value="Vibration">Vibration</option>
            </select>

            <label>Location</label>
            <input type="text" name="location" required>

            <label>Status</label>
            <select name="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>

            <button type="submit" name="add_sensor">Add Sensor</button>
        </form>
    </div>

    <div class="panel">
        <h2>Sensor List</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Status</th>
            </tr>

            <?php
            $result = $conn->query("SELECT * FROM sensors ORDER BY id DESC");

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['type'] . "</td>
                        <td>" . $row['location'] . "</td>
                        <td>" . $row['status'] . "</td>
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
