<?php 

include_once __DIR__ . '/App.php';

class Sitemap extends Config {

    public function map(){
        return $this->sitemap;
    }

    public function pages(){
        return array_keys($this->map());
    }

    public function page($key){
        return $this->navs()[$key];
    }

    public function count(){
        return count($this->sitemap);
    }

    

}