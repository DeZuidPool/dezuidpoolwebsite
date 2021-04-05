<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require_once '../php/Abonnement.php';

$updatedAbos = $_SESSION["updatedAbos"];
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$SQL = "UPDATE ABONNEMENT SET PAYED = ?, FIRSTDELDATE = ?  WHERE ID = ?";
$error = "";
$nofaults = true;
foreach ($updatedAbos as $abo) {
    if ($abo instanceof Abonnement) {
        $stmt = $conn->prepare($SQL);
        $startDate = null;
        if ($abo->get_firstDelDate() != null) {
            $startDate = date("Y-m-d",strtotime($abo->get_firstDelDate()));
        }
        $stmt->bind_param("ssi", $abo->get_payed(), $startDate,$abo->get_id());
        
        if (! $stmt->execute()) {
            $nofaults = false;
            $error .= $stmt->error . "\n";
        }
        
        $stmt->close();
    } else {
        $nofaults = false;
        $error .= "object not a ABONNEMENT!\n";
    }
}
$_SESSION["nofaults"] = $nofaults;
if (! $nofaults) {
    $_SESSION["error"] = $error;
}
$conn->close();
