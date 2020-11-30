<?php
// Start the session
if ( !isset($_SESSION) ) {
    session_start();
}
$customerid = $_SESSION["customerid"];

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT NAME, FIRSTNAME, GSM, LOGIN, DELIVERYTYPE, SORBETONLY, COMMUNICATIONS, COMMENTS FROM CUSTOMER WHERE ID = ?");
$stmt->bind_param("i",$customerid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0 and $result->num_rows == 1) {
    // output data of each row
    if($row = $result->fetch_assoc()) {
        $name = $row["NAME"];
        $firstName = $row["FIRSTNAME"];
        $gsm = $row["GSM"];
        $email = $row["LOGIN"];
        $deliveryType = $row["DELIVERYTYPE"];
        $sorbetOnly = $row["SORBETONLY"];
        $communications = $row["COMMUNICATIONS"];
        $comments = $row["COMMENTS"];
    }
} else {
    echo "bad results for ".$customerid;
}

$stmt->close();
$conn->close();
