<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}

$customerid = $_SESSION["customerid"];
$adressid = $_SESSION["adressid"];

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE DELIVERYADRESS SET STREET = ?, NBR = ?, ZIPCODE = ?, CITY = ?, REMARKS = ? WHERE CUSTOMERID = ? AND ID = ?");
$stmt->bind_param("sssssii",$street,$nbr,$zipCode,$city,$remarks,$customerid, $adressid);

if ($stmt->execute()) {
   
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
