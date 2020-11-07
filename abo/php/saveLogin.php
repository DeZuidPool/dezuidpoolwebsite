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

$stmt = $conn->prepare("INSERT INTO CUSTOMER (NAME,FIRSTNAME,GSM, LOGIN, PWD, DELIVERYTYPE, SORBETONLY, COMMUNICATIONS,COMMENTS) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssss",$name,$firstName,$gsm,$login,password_hash($password, PASSWORD_DEFAULT),$deliveryType,$sorbetOnly,$communications,$comments);

$customerid = "";
if ($stmt->execute()) {
    $customerid = $conn->insert_id;
   $_SESSION["customerid"] = $customerid;
} else {
   echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
