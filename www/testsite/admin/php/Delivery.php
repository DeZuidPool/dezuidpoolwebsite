<?php 
Class Delivery {
    
    private $aboId;
    private $flavor1;
    private $flavor2;
    private $delDate;

    public function __construct($aboId,$flavor1,$flavor2,$delDate) {
        $this->aboId = $aboId;
        $this->flavor1 = $flavor1;
        $this->flavor2 = $flavor2;
        $this->delDate = $delDate;
    }
    
    public function getFlavor1()
    {
        return $this->flavor1;
    }
    
    public function getFlavor2()
    {
        return $this->flavor2;
    }
    
    public function getAboId()
    {
        return $this->aboId;
    }
    
    public function getDelDate()
    {
        return $this->delDate;
    }
    
}

?>