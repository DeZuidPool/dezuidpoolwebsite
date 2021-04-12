<?php 
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require '../php/testinput.php';
require '../php/dbcredentials.php';

if (isset($_GET['login'])) {
    $login=test_input($_GET['login']);
    $_SESSION["login"] = $login;
    require '../php/updateCustomerOrders.php';
}
$nofaults = $_SESSION["nofaults"];
if (!$nofaults) {
    $error = $_SESSION["error"];
    echo $error;
} else {
    header('Location: customers.php');
}
?>