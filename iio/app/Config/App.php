<?php 

class Config {
    
    public function __construct( private $configFile = __DIR__ . '/../../../config.json' ){
        $this->config = json_decode(
            file_get_contents(
                $configFile
            ), true
        );
        
        $this->nav = $this->config['nav'];

    }

    public function get(){
        return $this->config;
    }

    public function save($configuration){
        file_put_contents(
            $this->configFile,
            json_encode($configuration, JSON_PRETTY_PRINT)
        );
    }
}