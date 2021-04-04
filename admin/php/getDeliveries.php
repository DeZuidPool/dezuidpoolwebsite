<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT cust.login as LOGIN, abo.id as ABOID, abo.DELIVERYTYPE as DELTYPE, abo.name as CONTACT, abo.firstdeldate as FIRSTDELDATE, abo.potspw as POTSPW, abo.comments as COMMENTS, ".
        " abo.gsm as GSM, CONCAT(abo.street, ' ', abo.nbr) as STREET, CONCAT(abo.zipcode, ' ', abo.city) as CITY, abo.adresremarks as ADRESREMARKS, ".
        " w.id as WEEKID, w.datum as WEEKDATE, w.flavor1 as FLAVOR1, w.flavor2 as FLAVOR2 ".
    " FROM CUSTOMER cust, ABONNEMENT abo LEFT JOIN WEEK w ON abo.ID = w.aboid where abo.CUSTOMERID = cust.ID and abo.PAYED = 'Y' and abo.PRODUCTTYPE = 'ABO' ".
    " ORDER BY LOGIN, ABOID, WEEKDATE");

$stmt->execute();
$result = $stmt->get_result();

$deliveries = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $deliveries[] = $row;
    }
    $_SESSION["deliveries"]=$deliveries;
} else {
    echo "no results";
}

$stmt->close();
$conn->close();
