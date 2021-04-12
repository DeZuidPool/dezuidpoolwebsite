<?php 
Class Customer {
    
    private $id;
    private $name;
    private $firstName;
    private $gsm;
    private $login;
    private $nbrorders;
    
    public function __construct($id,$name,$firstName,$login,$nbrOrders) {
        $this->id = $id;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->login = $login;
        $this->nbrorders = $nbrOrders;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getGsm()
    {
        return $this->gsm;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getNbrorders()
    {
        return $this->nbrorders;
    }


    
}

?>