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

$stmt = $conn->prepare("INSERT INTO CUSTOMER (NAME,FIRSTNAME,GSM, LOGIN, PWD, DELIVERYTYPE, SORBETONLY, COMMUNICATIONS,COMMENTS) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssss",$name,$firstName,$gsm,$email,password_hash($password, PASSWORD_DEFAULT),$deliveryType,$sorbetOnly,$communications,$comments);

$customerid = "";
if ($stmt->execute()) {
    $customerid = $conn->insert_id;
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
