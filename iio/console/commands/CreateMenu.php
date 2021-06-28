<?php

include_once __DIR__ . '/../../app/Support/Console/Console.php';
include_once __DIR__ . '/../../app/Support/Hash/Hash.php';
include_once __DIR__ . '/../../app/Config/Nav.php';


class CreateMenu extends Console {

    public function __construct(public $input, public $title = 'Create New Menu'){
        $this->desc($this->title);
        $this->config = new Nav('src');
        $this->hash = new Hash;
    }

    public function handle(){

        /**
         *  Start the build :::
         */
        $this->line('Creating a new Menu...');

        /**
         *  @ Get the configuration ::
         */
        $configuration = $this->config->get();

        /**
         *  @ Parse the input items :
         */
        if(
            !isset($this->input[1]) || !isset($this->input[2]) || !isset($this->input[3])
        ){
            $this->error('Error: Missing arguments in command, expected 3. Exiting...');
            return;
        }

        // -- Menu Name (Argument 1):
        $menu_name = $this->input[1];

        // -- Menu Type (Argument 2, "static" or "fluid"):
        $menu_type = $this->input[2];

        // -- Menu Method (Argument 3, set "-" if static method):
        $menu_method = $this->input[3];

        // -- Build Menu Object :
        $newMenu = [
            'id' => $this->hash->createObjHash(),
            'name' => $menu_name,
            'type' => $menu_type,
            'method' => $menu_method == '-' ? false : $menu_method,
            'items' => []
        ];

        // -- Add Menu to List :
        $navList = $this->config->addMenu($newMenu);

        // -- Mount Menu Object to Configuration :
        $configuration['nav'] = $navList;

        // -- Save Configuration :
        $this->config->save($configuration);


        /**
         * Complete :
         */

    }

}