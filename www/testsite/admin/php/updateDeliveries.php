<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require_once 'php/Delivery.php';

$updatedDeliveries = $_SESSION["updatedDeliveries"];
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$SQL = "INSERT INTO WEEK (ABOID,FLAVOR1,FLAVOR2,DATUM) values (?,?,?,?)";
$error = "";
$nofaults = true;
foreach ($updatedDeliveries as $delivery) {
    if ($delivery instanceof Delivery) {
        $stmt = $conn->prepare($SQL);
        $date = null;
        if ($delivery->getDelDate() != null) {
            $date = date("Y-m-d",strtotime($delivery->getDelDate()));
        }
        $stmt->bind_param("isss", $delivery->getAboId(), $delivery->getFlavor1(), $delivery->getFlavor2(), $date);
        
        if (! $stmt->execute()) {
            $nofaults = false;
            $error .= $stmt->error . "\n";
        }
        
        $stmt->close();
    } else {
        $nofaults = false;
        $error .= "object not a Delivery!\n";
    }
}
$_SESSION["nofaults"] = $nofaults;
if (! $nofaults) {
    $_SESSION["error"] = $error;
}
$conn->close();
