<?php
// Start the session
if ( !isset($_SESSION) ) {
    session_start();
}

require_once '../php/Customer.php';

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$customers=array();

$logging="";
$stmt = $conn->prepare("SELECT ID, LOGIN, NAME, FIRSTNAME, NBRORDERS FROM CUSTOMER order by NAME, FIRSTNAME ");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $customer = new Customer($row["ID"],$row["NAME"],$row["FIRSTNAME"],$row["LOGIN"],$row["NBRORDERS"]);
        $customers[] = $customer;
    }
    $_SESSION["customers"] = $customers;
} else {
    $_SESSION["customers"] = $customers;
    $logging = "No customers yet\n";
}
$stmt->close();

$conn->close();

if (strlen($logging)> 0) {
    echo $logging;
}
