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

    public function addPage($newPage){
        $this->sitemap[$this->count()] = $newPage;
        return $this->sitemap;
    }

    public function getIdByName($name){
        $this_id = false;
        foreach($this->sitemap as $map){
            if($map['name'] == $name){
                $this_id = $map['id'];
            }
        }
        return $this_id;
    }

    public function addItemToPage($id,$newItem){
        $newObj = [];
        foreach($this->sitemap as $key => $map){
            if($map['id'] == $id){
                $newObj = $this->addToItemsList($key,$newItem);
            }
        }
        return $newObj;
    }

    public function addToItemsList($key,$newItem){
        $this->sitemap[$key]['items'][count($this->sitemap[$key]['items'])] = $newItem;
        return $this->sitemap;
    }

}