<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require_once 'php/abonnement.php';

$updatedAbos = $_SESSION["updatedAbos"];
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$SQL = "UPDATE ABONNEMENT SET PAYED = ?, FIRSTDELDATE = ?, LASTDELDATE = ?  WHERE ID = ?";
$error = "";
$nofaults = true;
foreach ($updatedAbos as $abo) {
    if ($abo instanceof Abonnement) {
        $stmt = $conn->prepare($SQL);
        $startDate = null;
        if ($abo->get_firstDelDate() != null) {
            $startDate = date("Y-m-d",strtotime($abo->get_firstDelDate()));
        }
        $endDate = null;
        if ($abo->get_lastDelDate() != null) {
            $endDate = date("Y-m-d",strtotime($abo->get_lastDelDate()));
        }
        $stmt->bind_param("sssi", $abo->get_payed(), $startDate,$endDate,$abo->get_id());
        
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
