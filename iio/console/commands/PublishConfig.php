<?php

include_once __DIR__ . '/../../app/Support/Console/Console.php';
include_once __DIR__ . '/../../app/Config/App.php';


class PublishConfig extends Console {

    public function __construct(public $input, public $title = 'Publish Configuration File'){
        $this->desc($this->title);
        $this->config = new Config;
    }

    public function handle(){

        /**
         *  Start the build :::
         */
        $this->line('Publish Configutation File...');

        /**
         *  @ Publish Config File ::
        */
        $this->config->publish();

        /**
         * Complete :
        */

    }

}