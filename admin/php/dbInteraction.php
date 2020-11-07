<?php 
Class DbInteraction {
    
    private $dbservername = "ID323639_zuidpool.db.webhosting.be";
    private $dbusername = "ID323639_zuidpool";
    private $dbpassword = "Beerput007!!";
    private $dbname = "ID323639_zuidpool";
    // or load credentials in via constructor?
    
    public function __construct() {
        
    }
    
    public function saveCustomer(Customer $customer) {
        // Create connection
        $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $stmt = $conn->prepare("INSERT INTO CUSTOMER (NAME,FIRSTNAME,GSM, LOGIN, PWD) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$name,$firstName,$gsm,$login,password_hash($password, PASSWORD_DEFAULT));
        
        $customerId = $customer = "";
        if ($stmt->execute()) {
            $customerId = $conn->insert_id;
            // getcustomer
        } else {
            $customer= "Error: " . $stmt->error;
        }
        // put customer in session
        $_SESSION["customer"] = $customer;
        
        $stmt->close();
        $conn->close();
    }
    
}
?>