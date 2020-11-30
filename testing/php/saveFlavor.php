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
$stmt = $conn->prepare("INSERT INTO FLAVOR (NAME,DESCRIPTION,IJSTYPE, SELLING, COMINGSOON,VEGAN) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$newName,$newDescription,$newOfType,$newSelling,$newComingSoon,$newVegan);

if ($stmt->execute()) {
   $_SESSION["nofaults"]=true;
} else {
    $_SESSION["nofaults"]=false;
    $error = $stmt->error;
    $_SESSION["error"]=$error;
}

$stmt->close();
$conn->close();
