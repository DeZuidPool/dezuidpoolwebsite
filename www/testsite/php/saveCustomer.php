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
$stmt = $conn->prepare("INSERT INTO CUSTOMER (NAME,FIRSTNAME,GSM, LOGIN, PWD, COMMUNICATIONS) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$customer->getName(),$customer->getFirstName(),$customer->getGsm(),$customer->getLogin(),$customer->getPassword(),$customer->getCommunications());

$customerid = "";
if ($stmt->execute()) {
    $customerid = $conn->insert_id;
   $_SESSION["customerid"] = $customerid;
   $_SESSION["nofaults"]=true;
   // remove customer from session
   unset($_SESSION["customer"]);
} else {
    $_SESSION["nofaults"]=false;
    $error = $stmt->error;
    if (startsWith($error,"Duplicate entry")) {
        $_SESSION["emailErr"]="Dit emailadres wordt reeds gebruikt.";
    }
}

$stmt->close();
} else {
    $_SESSION["nofaults"]=false;
    $_SESSION["emailErr"]="customer not an instanceof Customer, sorry";
}
$conn->close();
