<?php 
Class Customer {
    
    private $id;
    private $name;
    private $firstName;
    private $gsm;
    private $login;
    private $password;
    private $nbrorders;
    private $communications;
    
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

    public function getPassword()
    {
        return $this->login;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getCommunications()
    {
        return $this->communications;
    }
    
    public function setCommunications($communications)
    {
        $this->communications = $communications;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    public function setGsm($gsm)
    {
        $this->gsm = $gsm;
    }
    
    public function setLogin($login)
    {
        $this->login = $login;
    }
    
    public function setNbrorders($nbrorders)
    {
        $this->nbrorders = $nbrorders;
    }
    
}

?>