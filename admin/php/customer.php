<?php 
Class Customer {
    
    private $id;
    private $name;
    private $firstName;
    private $gsm;
    private $login;
    private $pwd;
    
    public function __construct($name,$firstName,$gsm,$login,$password) {
        $this->name = $name;
        $this->firstName = $firstName;
        $this->gsm = $gsm;
        $this->login = $login;
        $this->pwd = $password;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function get_firstName() {
        return $this->firstName;
    }
    public function get_gsm() {
        return $this->gsm;
    }
    
    public function get_login() {
        return $this->login;
    }
    
    public function get_pwd() {
        return $this->pwd;
    }
     
    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_id() {
        return $this->id;
    }
}

Class DeliveryAdress {
    
    private $customer;
    private $street;
    private $nbr;
    private $zipCode;
    private $city;
    
    public function __construct($customer,$street,$nbr,$zipCode,$city) {
        $this->customer = $customer;
        $this->street = $street;
        $this->nbr = $nbr;
        $this->zipCode = $zipCode;
        $this->city = $city;
    }
    
    public function get_customer() {
        return $this->customer;
    }
    
    public function get_street() {
        return $this->street;
    }
}
?>