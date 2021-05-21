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
        $abo = new Abonnement();
        $abo->setDeliveryType($row["DELIVERYTYPE"]);
        $abo->setSorbetOnly($row["SORBETONLY"]);
        $abo->setPayed($row["PAYED"]);
        $abo->setComments($row["COMMENTS"]);
        $abo->setStreet($row["STREET"]);
        $abo->setNbr($row["NBR"]);
        $abo->setZipCode($row["ZIPCODE"]);
        $abo->setCity($row["CITY"]);
        $abo->setAdresRemarks($row["ADRESREMARKS"]);
        $abo->setId($row["ID"]);
        $abo->setName($row["NAME"]);
        $abo->setGsm($row["GSM"]);
        $abo->setPotspw($row["POTSPW"]);
        
        $_SESSION["abonnement"] = $abo;
        unset($_SESSION["id"]);
    }
} else {
    echo "bad results for ".$customerid."/".$id." results : ".$result->num_rows;
}

$stmt->close();
$conn->close();
