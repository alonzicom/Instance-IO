<?php 

class Config {
    
    public function __construct( 
        public $type = 'min', 
        private $configFile = __DIR__ . '/../../../config.json', 
        private $configFileSrc = __DIR__ . '/../../../config.src.json' 
    ){

        $this->config = json_decode(
            file_get_contents(
                $type == 'min' ? $configFile : $configFileSrc
            ), true
        );
        
        $this->nav = $this->config['nav'];
        $this->sitemap = $this->config['sitemap'];

    }

    public function get(){
        return $this->config;
    }

    public function save($configuration){
        file_put_contents(
            $this->type == 'min' ? $this->configFile : $this->configFileSrc,
            $this->type == 'min' ? 
                json_encode($configuration) : 
                json_encode($configuration, JSON_PRETTY_PRINT)
        );
    }

    public function publish(){
        $config = json_decode(file_get_contents($this->configFileSrc));
        file_put_contents(
            $this->configFile, json_encode($config)
        );
    }
}