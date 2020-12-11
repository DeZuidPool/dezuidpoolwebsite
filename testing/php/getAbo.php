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

$stmt = $conn->prepare("SELECT ID, NAME,GSM, DELIVERYTYPE, SORBETONLY, PAYED, COMMENTS, STREET, NBR, ZIPCODE, CITY, ADRESREMARKS FROM ABONNEMENT where CUSTOMERID = ? AND ID = ?");
$stmt->bind_param("ii",$customerid, $id);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0 && $result->num_rows == 1) {
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
    }
} else {
    echo "bad results for ".$customerid."/".$id." results : ".$result->num_rows;
}

$stmt->close();
$conn->close();
