<?php 

include_once __DIR__ . '/App.php';

class Nav extends Config {

    public function map(){
        return $this->nav;
    }

    public function navs(){
        return array_keys($this->map());
    }

    public function nav($key){
        return $this->navs()[$key];
    }


}