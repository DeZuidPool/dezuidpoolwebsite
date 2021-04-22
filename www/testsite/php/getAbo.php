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

$stmt = $conn->prepare("SELECT ID, NAME,GSM, DELIVERYTYPE, SORBETONLY, POTSPW, PAYED, COMMENTS, STREET, NBR, ZIPCODE, CITY, ADRESREMARKS FROM ABONNEMENT where CUSTOMERID = ? AND ID = ?");
$stmt->bind_param("ii",$customerid, $id);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0 && $result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        $abonnement = new Abonnement();
        $abonnement->setDeliveryType($row["DELIVERYTYPE"]);
        $abonnement->setSorbetOnly($row["SORBETONLY"]);
        $abonnement->setPayed($row["PAYED"]);
        $abonnement->setComments($row["COMMENTS"]);
        $abonnement->setStreet($row["STREET"]);
        $abonnement->setNbr($row["NBR"]);
        $abonnement->setZipCode($row["ZIPCODE"]);
        $abonnement->setCity($row["CITY"]);
        $abonnement->setAdresRemarks($row["ADRESREMARKS"]);
        $abonnement->setId($row["ID"]);
        $abonnement->setName($row["NAME"]);
        $abonnement->setGsm($row["GSM"]);
        $abonnement->setPotspw($row["POTSPW"]);
    }
} else {
    echo "bad results for ".$customerid."/".$id." results : ".$result->num_rows;
}

$stmt->close();
$conn->close();
