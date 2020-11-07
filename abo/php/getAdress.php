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

$stmt = $conn->prepare("SELECT STREET, NBR, ZIPCODE, CITY, REMARKS FROM DELIVERYADRESS where CUSTOMERID = ?");
$stmt->bind_param("i",$customerid);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0 and $result->num_rows == 1) {
    // output data of first row
    if($row = $result->fetch_assoc()) {
        $street = $row["STREET"];
        $nbr = $row["NBR"];
        $zipCode = $row["ZIPCODE"];
        $city = $row["CITY"];
        $remarks = $row["REMARKS"];
    }
} else {
    echo "bad results for ".$customerid;
}

$stmt->close();
$conn->close();
