<?php
// Start the session
if ( !isset($_SESSION) ) {
    session_start();
}

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$flavors=array();
$soonFlavors=array();
$otherFlavors=array();

$logging="";
$stmt = $conn->prepare("SELECT NAME, DESCRIPTION, IJSTYPE, VEGAN FROM FLAVOR WHERE SELLING = 'Y' order by NAME ");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $flavors[] = $row;
    }
    $_SESSION["activeFlavors"] = $flavors;
} else {
    $_SESSION["activeFlavors"] = $flavors;
    $logging = "No active flavors yet\n";
}
$stmt->close();

$stmt = $conn->prepare("SELECT NAME, DESCRIPTION, IJSTYPE, VEGAN FROM FLAVOR WHERE COMINGSOON='Y' order by NAME ");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $soonFlavors[] = $row;
    }
    $_SESSION["soonFlavors"] = $soonFlavors;
} else {
    $_SESSION["soonFlavors"] = $soonFlavors;
    $logging .= "No soon flavors yet\n";
}
$stmt->close();

$stmt = $conn->prepare("SELECT NAME, DESCRIPTION, IJSTYPE, VEGAN FROM FLAVOR WHERE SELLING = 'N' and COMINGSOON='N' order by NAME ");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $otherFlavors[] = $row;
    }
    $_SESSION["otherFlavors"] = $otherFlavors;
} else {
    $_SESSION["otherFlavors"] = $otherFlavors;
    $logging .= "No other flavors yet\n";
}
$stmt->close();

$conn->close();

if (strlen($logging)> 0) {
    echo $logging;
}
