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

$stmt = $conn->prepare("SELECT ID, NAME,GSM, DELIVERYTYPE, PAYED, STREET, NBR, ZIPCODE, CITY, ADRESREMARKS FROM ABONNEMENT where CUSTOMERID = ? and PRODUCTTYPE='VAL'");
$stmt->bind_param("i",$customerid);

$stmt->execute();
$result = $stmt->get_result();



$vals = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $payed = $row["PAYED"];
        $street = $row["STREET"];
        $nbr = $row["NBR"];
        $zipCode = $row["ZIPCODE"];
        $city = $row["CITY"];
        $adresRemarks = $row["ADRESREMARKS"];
        $id = $row["ID"];
        $name = $row["NAME"];
        $gsm = $row["GSM"];
        $deliveryType= $row["DELIVERYTYPE"];
        $valentijn = new Valentijn();
        $valentijn->set_id($id);
        $valentijn->set_adresRemarks($adresRemarks);
        $valentijn->set_city($city);
        $valentijn->set_zipCode($zipCode);
        $valentijn->set_nbr($nbr);
        $valentijn->set_street($street);
        $valentijn->set_deliveryType($deliveryType);
        $valentijn->set_name($name);
        $valentijn->set_gsm($gsm);
        $valentijn->set_payed($payed);
        $vals[] = $valentijn;
    }
    $_SESSION["customerid"]= $customerid;
    $_SESSION["valentijns"]=$vals;
} else {
    echo "bad results for ".$customerid." results : ".$result->num_rows;
}

$stmt->close();
$conn->close();
