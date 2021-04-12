<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require_once '../php/Flavor.php';

$flavors = $_SESSION["flavors"];
// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$SQL = "UPDATE FLAVOR SET NAME = ?, DESCRIPTION = ?,IJSTYPE = ?, SELLING = ?, COMINGSOON = ?,VEGAN = ? WHERE ID = ?";
$error = "";
$nofaults = true;
foreach ($flavors as $flavor) {
    if ($flavor instanceof Flavor) {
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("ssssssi", $flavor->get_name(), $flavor->get_description(), $flavor->get_ijstype(), $flavor->get_selling(), $flavor->get_comingsoon(), $flavor->get_vegan(),$flavor->get_id());

        if (! $stmt->execute()) {
            if ($nofaults) {
                $nofaults = false;
            }
            $error .= $stmt->error . "\n";
        }

        $stmt->close();
    } else {
        $nofaults = false;
        $error .= "object not a FLAVOR!\n";
    }
}
$_SESSION["nofaults"] = $nofaults;
if (! $nofaults) {
    $_SESSION["error"] = $error;
}
$conn->close();
