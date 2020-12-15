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

$stmt = $conn->prepare("select c.login as LOGIN, a.id as ABOID, a.name as ABONAME, a.payed as ABOPAYED, a.firstdeldate as ABOBEGIN,  a.lastdeldate as ABOEND from ABONNEMENT a, CUSTOMER c where a.CUSTOMERID = c.id");

$stmt->execute();
$result = $stmt->get_result();

$abos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $abos[] = $row;
    }
    $_SESSION["abonnementen"]=$abos;
} else {
    echo "no results";
}

$stmt->close();
$conn->close();
