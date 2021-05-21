<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}
$customerid = $_SESSION["customerid"];
$abo = $_SESSION["abonnement"];
unset($_SESSION["abonnement"]);
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("INSERT INTO ABONNEMENT (NAME, GSM, DELIVERYTYPE, SORBETONLY, POTSPW, COMMENTS, STREET, NBR, ZIPCODE, CITY, ADRESREMARKS, CUSTOMERID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssssssi",$abo->getName(),$abo->getGsm(),$abo->getDeliveryType(),$abo->getSorbetOnly(), $abo->getPotspw(), $abo->getComments(), $abo->getStreet(),$abo->getNbr(),$abo->getZipCode(),$abo->getCity(),$abo->getAdresRemarks(),$customerid);

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
