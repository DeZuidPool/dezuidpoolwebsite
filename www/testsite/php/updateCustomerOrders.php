<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

$login = $_SESSION["login"];
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$SQL = "UPDATE CUSTOMER SET NBRORDERS = NBRORDERS+1  WHERE LOGIN = ?";
$error = "";
$nofaults = true;
$stmt = $conn->prepare($SQL);
$stmt->bind_param("s", $login);
        
if (! $stmt->execute()) {
    $nofaults = false;
    $error .= $stmt->error . "\n";
}
        
$stmt->close();
$_SESSION["nofaults"] = $nofaults;
if (! $nofaults) {
    $_SESSION["error"] = $error;
}
$conn->close();
