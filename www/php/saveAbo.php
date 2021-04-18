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
$stmt = $conn->prepare("INSERT INTO ABONNEMENT (NAME, GSM, DELIVERYTYPE, SORBETONLY, POTSPW, COMMENTS, STREET, NBR, ZIPCODE, CITY, ADRESREMARKS, CUSTOMERID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssssssi",$name,$gsm,$deliveryType,$sorbetOnly, $potspw, $comments, $street,$nbr,$zipCode,$city,$adresRemarks,$customerid);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
