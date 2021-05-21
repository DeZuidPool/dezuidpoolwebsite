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

$stmt = $conn->prepare("SELECT ID, NAME,GSM, DELIVERYTYPE, SORBETONLY, POTSPW, PAYED, COMMENTS, STREET, NBR, ZIPCODE, CITY, ADRESREMARKS FROM ABONNEMENT where CUSTOMERID = ? and PRODUCTTYPE='ABO' ");
$stmt->bind_param("i",$customerid);

$stmt->execute();
$result = $stmt->get_result();



$abos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $deliveryType = $row["DELIVERYTYPE"];
        $sorbetOnly = $row["SORBETONLY"];
        $payed = $row["PAYED"];
        $comments = $row["COMMENTS"];
        $street = $row["STREET"];
        $nbr = $row["NBR"];
        $zipCode = $row["ZIPCODE"];
        $city = $row["CITY"];
        $adresRemarks = $row["ADRESREMARKS"];
        $id = $row["ID"];
        $name = $row["NAME"];
        $gsm = $row["GSM"];
        $potspw = $row["POTSPW"];
        $abo = new Abonnement();
        $abo->setId($id);
        $abo->set_adresRemarks($adresRemarks);
        $abo->setCity($city);
        $abo->set_zipCode($zipCode);
        $abo->setNbr($nbr);
        $abo->setStreet($street);
        $abo->setComments($comments);
        $abo->set_sorbetOnly($sorbetOnly);
        $abo->set_deliveryType($deliveryType);
        $abo->setName($name);
        $abo->setGsm($gsm);
        $abo->setPayed($payed);
        $abo->setPotspw($potspw);
        $abos[] = $abo;
    }
    $_SESSION["customerid"]= $customerid;
    $_SESSION["abonnementen"]=$abos;
} else {
//    echo "bad results for ".$customerid." results : ".$result->num_rows;
    $_SESSION["customerid"]= $customerid;
    $_SESSION["abonnementen"]=$abos;
   
}

$stmt->close();
$conn->close();
