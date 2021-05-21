<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}
$customerid = $_SESSION["customerid"];
$abo = $_SESSION["abonnement"];

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("UPDATE ABONNEMENT SET NAME = ?, GSM = ?, DELIVERYTYPE = ?, SORBETONLY = ?, POTSPW = ?, COMMENTS = ?, STREET = ?, NBR = ?, ZIPCODE = ?, CITY = ?, ADRESREMARKS = ? WHERE CUSTOMERID = ? AND ID = ?");
$stmt->bind_param("sssssssssssii",$abo->getName(),$abo->getGsm(),$abo->getDeliveryType(),$abo->getSorbetOnly(), $abo->getPotspw(), $abo->getComments(), $abo->getStreet(),$abo->getNbr(),$abo->getZipCode(),$abo->getCity(),$abo->getAdresRemarks(),$customerid,$abo->getId());

if ($stmt->execute()) {
    $aboid = $conn->insert_id;
    $abo->setId($aboid);
    $_SESSION["abonnement"]=$abo;
} else
{
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
