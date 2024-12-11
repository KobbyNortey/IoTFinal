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

if (isset($_GET['node_name'])) {
    $node_name = htmlspecialchars(strip_tags($_GET['node_name']));

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM SensorReadings WHERE node_name = ? ORDER BY timestamp DESC");
    $stmt->bind_param("s", $node_name);
    $stmt->execute();
    $result = $stmt->get_result();

    $readings = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $readings[] = $row;
        }
    }

    // Return the readings as JSON
    echo json_encode($readings);

    $stmt->close();
} else {
    echo json_encode(["error" => "Node name not provided"]);
}

$conn->close();
?>
