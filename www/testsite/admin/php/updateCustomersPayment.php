<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require_once 'php/customer.php';

$customers = $_SESSION["customers"];
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$SQL = "UPDATE CUSTOMER SET PAYED = ? WHERE ID = ?";
$error = "";
$nofaults = true;
foreach ($customers as $customer) {
    if ($customer instanceof Customer) {
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("si", $customer->get_payed(), $customer->get_id());
        
        if (! $stmt->execute()) {
            if ($nofaults) {
                $nofaults = false;
            }
            $error .= $stmt->error . "\n";
        }

        $stmt->close();
    } else {
        $nofaults = false;
        $error .= "object not a CUSTOMER!\n";
    }
}
$_SESSION["nofaults"] = $nofaults;
if (! $nofaults) {
    $_SESSION["error"] = $error;
}
$conn->close();
