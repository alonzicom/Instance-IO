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

    public function getIdByName($name, $sitemap = null){

        $this_id = false;
        $sitemap = $sitemap ?? $this->sitemap;

        foreach($sitemap as $map){
            if(!$this_id){
                if($map['name'] == $name){
                    return $map['id'];
                }
                $this_id = $this->getIdByName($name,$map['items']);
            }
        }

        return $this_id;

    }

    public function addItemToPage($parent_id,$newItem){
        return $this->morphSitemap($this->sitemap, $parent_id, $newItem);
    }

    public function morphSitemap($sitemap, $parent_id, $obj){

        $newSitemap = [];

        foreach($sitemap as $map){

            if($map['id'] == $parent_id){
                
                $map['items'][count($map['items'])] = $obj;
                $newmap = $map;

            }else if(
                !empty($map['items'])
            ){
                $map['items'] = $this->morphSitemap($map['items'], $parent_id, $obj);
                $newmap = $map;

            }else {
                $newmap = $map;
            }

            $newSitemap[] = $newmap;
        
        }

        return $newSitemap;

    }



}