<?php 
Class Flavor {
    
    private $id;
    private $name;
    private $description;
    private $ijstype;
    private $selling;
    private $comingsoon;
    private $vegan;
    
    public function __construct($name,$description,$ijstype,$selling,$comingsoon,$vegan) {
        $this->name = $name;
        $this->description = $description;
        $this->ijstype = $ijstype;
        $this->selling = $selling;
        $this->comingsoon = $comingsoon;
        $this->vegan = $vegan;
    }
    
    public function get_name() {
        return $this->name;
    }
    
    public function get_description() {
        return $this->description;
    }
    public function get_selling() {
        return $this->selling;
    }
    
    public function get_comingsoon() {
        return $this->comingsoon;
    }
    
    public function get_vegan() {
        return $this->vegan;
    }
     
    public function get_ijstype() {
        return $this->ijstype;
    }
    
    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_id() {
        return $this->id;
    }
}

?>