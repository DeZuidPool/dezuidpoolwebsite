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

$stmt = $conn->prepare("select c.login as LOGIN, a.id as ABOID, a.name as ABONAME, a.payed as ABOPAYED, a.firstdeldate as ABOBEGIN, a.POTSPW as POTSPW from ABONNEMENT a, CUSTOMER c where a.CUSTOMERID = c.id and a.PRODUCTTYPE= 'VAL'");

$stmt->execute();
$result = $stmt->get_result();

$vals = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $vals[] = $row;
    }
    $_SESSION["valentijns"]=$vals;
} else {
    echo "no results";
}

$stmt->close();
$conn->close();
