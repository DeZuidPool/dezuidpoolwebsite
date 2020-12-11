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

$stmt = $conn->prepare("SELECT ID, NAME,GSM, DELIVERYTYPE, SORBETONLY, PAYED, COMMENTS, STREET, NBR, ZIPCODE, CITY, ADRESREMARKS FROM ABONNEMENT where CUSTOMERID = ?");
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
        $abonnement = new Abonnement();
        $abonnement->set_id($id);
        $abonnement->set_adresRemarks($adresRemarks);
        $abonnement->set_city($city);
        $abonnement->set_zipCode($zipCode);
        $abonnement->set_nbr($nbr);
        $abonnement->set_street($street);
        $abonnement->set_comments($comments);
        $abonnement->set_sorbetOnly($sorbetOnly);
        $abonnement->set_deliveryType($deliveryType);
        $abonnement->set_name($name);
        $abonnement->set_gsm($gsm);
        $abonnement->set_payed($payed);
        $abos[] = $abonnement;
    }
    $_SESSION["customerid"]= $customerid;
    $_SESSION["abonnementen"]=$abos;
} else {
    echo "bad results for ".$customerid." results : ".$result->num_rows;
}

$stmt->close();
$conn->close();
