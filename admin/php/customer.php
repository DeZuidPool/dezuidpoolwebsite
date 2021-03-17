<?php 
Class Customer {
    
    private $id;
    private $name;
    private $firstName;
    private $gsm;
    private $login;

    
    
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
    
    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_id() {
        return $this->id;
    }
}

?>