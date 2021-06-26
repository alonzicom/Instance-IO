<?php 

class Config {

    private $configFile = __DIR__ . '/../../../config.json';
    private $navConfigFile = __DIR__ . '/../../config/nav.json';
    
    public function __construct(){
        
        $this->config = json_decode(
            file_get_contents(
                $configFile
            ), true
        );
        
        $this->nav = json_decode(
            file_get_contents(
                $navConfigFile
            ), true
        );


    }

}