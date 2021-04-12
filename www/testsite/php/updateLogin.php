<?php
// Start the session
if ( !isset($_SESSION) ) {
    session_start();
}
$customerid = $_SESSION["customerid"];

function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE CUSTOMER SET NAME = ?, FIRSTNAME = ?, GSM = ?, LOGIN = ?, PWD = ?, COMMUNICATIONS = ? WHERE ID = ?");
$stmt->bind_param("ssssssi",$lastName,$firstName,$gsmCust,$email,password_hash($password, PASSWORD_DEFAULT),$communications, $customerid);

if ($stmt->execute()) {
   $_SESSION["customerid"] = $customerid;
   $_SESSION["nofaults"]=true;
} else {
    $_SESSION["nofaults"]=false;
    $error = $stmt->error;
    if (startsWith($error,"Duplicate entry")) {
        $_SESSION["emailErr"]="Dit emailadres wordt reeds gebruikt.";
    }
}

$stmt->close();
$conn->close();
