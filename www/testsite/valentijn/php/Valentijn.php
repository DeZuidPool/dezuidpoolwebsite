<?php 
Class Valentijn {
    
    private $id;
    private $payed;
    private $name;
    private $gsm;
    private $deliveryType;
    private $communications;
    private $street;
    private $nbr;
    private $zipCode;
    private $city;
    private $adresRemarks;
    
    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_id() {
        return $this->id;
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
    
    public function get_communications() {
        return $this->communications;
    }
    
    public function set_communications($communications) {
        $this->communications = $communications;
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
    
    public function set_street($street) {
         $this->street = $street;
    }
    public function set_nbr($nbr) {
         $this->nbr = $nbr;
    }
    
    public function set_zipCode($zipCode) {
         $this->zipCode = $zipCode;
    }
    
    public function set_city($city) {
         $this->city = $city;
    }
    
    public function get_adresRemarks() {
        return $this->adresRemarks;
    }
    
    public function set_adresRemarks($adresRemarks) {
        $this->adresRemarks = $adresRemarks;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function set_name($name) {
        $this->name=$name;
    }
    
    public function get_gsm() {
        return $this->gsm;
    }
    
    public function set_gsm($gsm) {
        $this->gsm = $gsm;
    }
    
}
?>