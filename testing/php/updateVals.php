<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require_once 'php/Valentijn.php';

$updatedAbos = $_SESSION["updatedAbos"];
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$SQL = "UPDATE ABONNEMENT SET PAYED = ?  WHERE ID = ?";
$error = "";
$nofaults = true;
foreach ($updatedAbos as $val) {
    if ($val instanceof Valentijn) {
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("si", $val->get_payed(), $val->get_id());
        
        if (! $stmt->execute()) {
            $nofaults = false;
            $error .= $stmt->error . "\n";
        }
        
        $stmt->close();
    } else {
        $nofaults = false;
        $error .= "object not a Valentijn!\n";
    }
}
$_SESSION["nofaults"] = $nofaults;
if (! $nofaults) {
    $_SESSION["error"] = $error;
}
$conn->close();
