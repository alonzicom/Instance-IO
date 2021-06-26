<?php

include_once __DIR__ . '/../../InstanceIO.php';
include_once __DIR__ . '/../../app/Support/Console/Console.php';

class BuildStaticWeb extends Console {

    public function __construct(public $title = 'Build Static Website'){
        $this->IIO = new IIO('static');
        $this->desc($this->title);
    }

    public function handle(){

        /**
         *  Start the build :::
         */
        $this->line('Starting the build process...');

        /**
         *  Running the Build ::
         */
        $this->IIO->Go();

        /**
         * Complete :
         */

    }

}