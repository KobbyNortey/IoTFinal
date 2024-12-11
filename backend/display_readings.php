<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_project";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Fetch readings
$sql = "SELECT node_name, timestamp, temperature, humidity, light_intensity FROM SensorReadings ORDER BY timestamp DESC";
$result = $conn->query($sql);

$readings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $readings[] = $row;
    }
}

// Return readings as JSON
echo json_encode($readings);

$conn->close();
?>
