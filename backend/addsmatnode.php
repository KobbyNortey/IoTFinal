<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "final_project";

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $node_name = htmlspecialchars(strip_tags($_POST['node_name']));
    $location = htmlspecialchars(strip_tags($_POST['location']));

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO SmartNodes (name, location) VALUES (?, ?)");
    $stmt->bind_param("ss", $node_name, $location);

    // Execute and provide feedback
    if ($stmt->execute()) {
        echo "Node successfully added.";
    } else {
        echo "Error adding node: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
