<?php 
Class Customer {
    
    private $id;
    private $name;
    private $firstName;
    private $gsm;
    private $login;

    
    private $payed;
    private $deliveryType;
    private $sorbetOnly;
    private $communications;
    private $comments;
    
    public function get_name() {
        return $this->name;
    }
    
    public function set_name($name) {
        $this->name = $name;
    }
    
    public function get_firstName() {
        return $this->firstName;
    }
    
    public function set_firstName($firstName) {
        $this->firstName = $firstName;
    }
    
    public function get_gsm() {
        return $this->gsm;
    }
    
    public function set_gsm($gsm) {
        $this->gsm = $gsm;
    }
    
    public function get_login() {
        return $this->login;
    }
    
    public function set_login($login) {
        $this->login = $login;
    }
    
    public function get_payed() {
        return $this->payed;
    }
    
    public function set_payed($payed) {
        $this->payed = $payed;
    }
    
    public function get_deliveryType() {
        return $this->deliveryType;
    }
    
    public function set_deliveryType($deliveryType) {
        $this->deliveryType = $deliveryType;
    }
    
    public function get_sorbetOnly() {
        return $this->sorbetOnly;
    }
    
    public function set_sorbetOnly($sorbetOnly) {
        $this->sorbetOnly = $sorbetOnly;
    }
    
    public function get_communications() {
        return $this->communications;
    }
    
    public function set_communications($communications) {
        $this->communications = $communications;
    }
    
    public function get_comments() {
        return $this->comments;
    }
    
    public function set_comments($comments) {
        $this->comments = $comments;
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
    public function get_nbr() {
        return $this->nbr;
    }
    
    public function get_zipCode() {
        return $this->zipCode;
    }
    public function get_city() {
        return $this->city;
    }

}
?>