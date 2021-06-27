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

    public function count(){
        return count($this->nav);
    }

    public function addMenu($newMenu){
        $this->nav[$this->count()] = $newMenu;
        return $this->nav;
    }

    public function getIdByName($name){
        $this_id = false;
        foreach($this->nav as $nav){
            if($nav['name'] == $name){
                $this_id = $nav['id'];
            }
        }
        return $this_id;
    }

    public function addItemToMenu($id,$newItem){
        $newObj = [];
        foreach($this->nav as $key => $nav){
            if($nav['id'] == $id){
                $newObj = $this->addToItemsList($key,$newItem);
            }
        }
        return $newObj;
    }

    public function addToItemsList($key,$newItem){
        
        $this->nav[$key]['items'][count($this->nav[$key]['items'])] = $newItem;

        return $this->nav;

    }



}