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

$stmt = $conn->prepare("SELECT ID, PWD FROM CUSTOMER WHERE LOGIN = ?");
$stmt->bind_param("s",$login);
$stmt->execute();
$result = $stmt->get_result();

$customerid = $pwd = "";

if ($result->num_rows > 0 and $result->num_rows == 1) {
    // output data of one row
    if($row = $result->fetch_assoc()) {
        $customerid = $row["ID"];
        $pwd = $row["PWD"];
    }
    if (password_verify($password,$pwd)) {
        $_SESSION["customerid"] = $customerid;
    } else {
        $_SESSION["customerid"] = "none";
    }
} else {
    $_SESSION["customerid"] = "none";
}
unset( $_SESSION["login"]);
unset( $_SESSION["pwd"]);

$stmt->close();
$conn->close();
