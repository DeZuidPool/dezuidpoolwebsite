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
$stmt = $conn->prepare("INSERT INTO FLAVOR (NAME,DESCRIPTION,IJSTYPE, SELLING, COMINGSOON,VEGAN, ALCOHOL,EIGEEL,GLUTEN) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssss",$newName,$newDescription,$newOfType,$newSelling,$newComingSoon,$newVegan,$newAlcohol,$newEigeel,$newGluten);

if ($stmt->execute()) {
   $_SESSION["nofaults"]=true;
} else {
    $_SESSION["nofaults"]=false;
    $error = $stmt->error;
    $_SESSION["error"]=$error;
}

$stmt->close();
$conn->close();
