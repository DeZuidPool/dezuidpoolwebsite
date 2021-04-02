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

$logging="";
$stmt = $conn->prepare("SELECT NAME, DESCRIPTION, IJSTYPE, VEGAN, ALCOHOL,EIGEEL,GLUTEN,SELLING,COMINGSOON FROM FLAVOR order by NAME ");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $flavors[] = $row;
    }
    $_SESSION["flavors"] = $flavors;
} else {
    $_SESSION["flavors"] = $flavors;
    $logging = "No flavors yet\n";
}
$stmt->close();


$conn->close();

if (strlen($logging)> 0) {
    echo $logging;
}
