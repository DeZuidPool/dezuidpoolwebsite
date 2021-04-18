<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}
$customerid = $_SESSION["customerid"];
$id = $_SESSION["id"];

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("UPDATE ABONNEMENT SET NAME = ?, GSM = ?, DELIVERYTYPE = ?, SORBETONLY = ?, POTSPW = ?, COMMENTS = ?, STREET = ?, NBR = ?, ZIPCODE = ?, CITY = ?, ADRESREMARKS = ? WHERE CUSTOMERID = ? AND ID = ?");
$stmt->bind_param("sssssssssssii",$name,$gsm,$deliveryType,$sorbetOnly, $potspw, $comments, $street,$nbr,$zipCode,$city,$adresRemarks,$customerid,$id);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
