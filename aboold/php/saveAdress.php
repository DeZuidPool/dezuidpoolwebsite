<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}
$customerid = $_SESSION["customerid"];

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO DELIVERYADRESS (STREET, NBR, ZIPCODE, CITY, REMARKS, CUSTOMERID) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("sssssi",$street,$nbr,$zipCode,$city,$remarks,$customerid);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
