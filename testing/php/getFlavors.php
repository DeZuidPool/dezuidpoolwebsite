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

$stmt = $conn->prepare("SELECT ID,NAME, DESCRIPTION, IJSTYPE, SELLING, COMINGSOON,VEGAN,ALCOHOL,EIGEEL,GLUTEN FROM FLAVOR order by NAME");
$stmt->execute();
$result = $stmt->get_result();

$flavors=array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $flavors[] = $row;
    }
    $_SESSION["flavors"] = $flavors;
} else {
    $_SESSION["flavors"] = $flavors;
    echo "No flavors yet";
}

$stmt->close();
$conn->close();
