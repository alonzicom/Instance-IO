<?php 

class Config {
    
    public function __construct( 
        public $type = 'lock', 
        private $configFileLock = __DIR__ . '/../../../config.lock.json', 
        private $configFile = __DIR__ . '/../../../config.json' 
    ){

        $this->config = json_decode(
            file_get_contents(
                $type == 'lock' ? $configFileLock : $configFile
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
            $this->type == 'lock' ? $this->configFileLock : $this->configFile,
            $this->type == 'lock' ? 
                json_encode($configuration) : 
                json_encode($configuration, JSON_PRETTY_PRINT)
        );
    }

    public function publish(){
        $config = json_decode(file_get_contents($this->configFile));
        file_put_contents(
            $this->configFileLock, json_encode($config)
        );
    }
}