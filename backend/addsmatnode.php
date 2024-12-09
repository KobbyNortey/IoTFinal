<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "final_project";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(["error" => "Database connection failed"]));
    }

    $name = htmlspecialchars(strip_tags($_POST['node_name']));
    $location = htmlspecialchars(strip_tags($_POST['location']));

    $stmt = $conn->prepare("INSERT INTO SmartNodes (name, location) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $location);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Node added successfully!"]);
    } else {
        echo json_encode(["error" => "Failed to add node"]);
    }

    $stmt->close();
    $conn->close();
}
?>
