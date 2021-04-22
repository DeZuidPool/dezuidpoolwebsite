<?php
// Start the session
if ( !isset($_SESSION) ) {
    session_start();
}

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
$customer = $_SESSION["customer"];

if ($customer instanceof Customer) {
$stmt = $conn->prepare("UPDATE CUSTOMER SET NAME = ?, FIRSTNAME = ?, GSM = ?, LOGIN = ?, PWD = ?, COMMUNICATIONS = ? WHERE ID = ?");
$stmt->bind_param("ssssssi",$customer->getName(),$customer->getFirstName(),$customer->getGsm(),$customer->getLogin(),$customer->getPassword(),$customer->getCommunications(), $customer->getId());

if ($stmt->execute()) {
   $_SESSION["customerid"] = $customer->getId();
   $_SESSION["nofaults"]=true;
} else {
    $_SESSION["nofaults"]=false;
    $error = $stmt->error;
    if (startsWith($error,"Duplicate entry")) {
        $_SESSION["emailErr"]="Dit emailadres wordt reeds gebruikt.";
    }
}

$stmt->close();
} else {
    unset($_SESSION["customer"]);
}
$conn->close();
