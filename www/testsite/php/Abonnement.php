<?php 
Class Abonnement {
    
    private $id;
    private $firstDelDate;
    private $payed;
    private $name;
    private $gsm;
    private $deliveryType;
    private $sorbetOnly;
    private $potspw;
    private $communications;
    private $comments;
    private $street;
    private $nbr;
    private $zipCode;
    private $city;
    private $adresRemarks;
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setFirstDelDate($firstDelDate) {
        $this->firstDelDate = $firstDelDate;
    }
    
    public function getFirstDelDate() {
        return $this->firstDelDate;
    }
    
    public function getPayed() {
        return $this->payed;
    }
    
    public function setPayed($payed) {
        $this->payed = $payed;
    }
    
    public function getDeliveryType() {
        return $this->deliveryType;
    }
    
    public function setDeliveryType($deliveryType) {
        $this->deliveryType = $deliveryType;
    }
    
    public function getSorbetOnly() {
        return $this->sorbetOnly;
    }
    
    public function setSorbetOnly($sorbetOnly) {
        $this->sorbetOnly = $sorbetOnly;
    }
    
    public function getCommunications() {
        return $this->communications;
    }
    
    public function setCommunications($communications) {
        $this->communications = $communications;
    }
    public function getComments() {
        return $this->comments;
    }
    
    public function setComments($comments) {
        $this->comments = $comments;
    }
    
    public function getStreet() {
        return $this->street;
    }
    public function getNbr() {
        return $this->nbr;
    }
    
    public function getZipCode() {
        return $this->zipCode;
    }
    public function getCity() {
        return $this->city;
    }
    
    public function setStreet($street) {
         $this->street = $street;
    }
    public function setNbr($nbr) {
         $this->nbr = $nbr;
    }
    
    public function setZipCode($zipCode) {
         $this->zipCode = $zipCode;
    }
    
    public function setCity($city) {
         $this->city = $city;
    }
    
    public function getAdresRemarks() {
        return $this->adresRemarks;
    }
    
    public function setAdresRemarks($adresRemarks) {
        $this->adresRemarks = $adresRemarks;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name=$name;
    }
    
    public function getGsm() {
        return $this->gsm;
    }
    
    public function setGsm($gsm) {
        $this->gsm = $gsm;
    }
    
    public function getPotspw() {
        return $this->potspw;
    }
    
    public function setPotspw($potspw) {
        $this->potspw = $potspw;
    }
}
?>