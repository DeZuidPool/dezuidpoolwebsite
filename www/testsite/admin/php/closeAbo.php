<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}

$closeId = $_SESSION["closeId"];
echo '\nclosing abo '.$closeId;

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("UPDATE ABONNEMENT SET PAYED = 'N' WHERE ID = ?");
$stmt->bind_param("i",$closeId);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();