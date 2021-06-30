<?php

include_once __DIR__ . '/../../app/Support/Console/Console.php';
include_once __DIR__ . '/../../app/Config/Nav.php';

class AddToMenu extends Console {

    public function __construct(public $input, public $title = 'Add Item To Menu'){
        $this->desc($this->title);
        $this->config = new Nav('src');
    }

    public function handle(){

        /**
         *  Start the build :::
         */
        $this->line('Adding Item to Existing Menu...');

        /**
         *  @ Get the configuration ::
         */
        $configuration = $this->config->get();

        /**
         *  @ Parse the input items :
         */
        if(
            
            // - Item Label :
            !isset($this->input[1]) ||

            // -- Item Slug/Path/URL :
            !isset($this->input[2]) ||

            // -- Item Target (ex. "_blank" or "-") :
            !isset($this->input[3]) ||

            // -- Parent Menu :
            !isset($this->input[4]) ||

            // -- Child Menu (leave "-" if none) :
            !isset($this->input[5])    

        ){
            $this->error('Error: Missing arguments in command, expected 5. Label, Slug/Path/URL, Target, Parent, Child. Exiting...');
            return;
        }

        // -- Item Label :
        $item_label = $this->input[1];

        // -- Item Slug/Path/URL :
        $item_path = $this->input[2];

        // -- Item Target :
        $item_target = $this->input[3] == '-' ? false : $this->input[3];

        // -- Item Parent :
        $item_parent = $this->config->getIdByName($this->input[4]);

        // -- Item Child :
        $item_child_menu = $this->config->getIdByName($this->input[5]);

        // -- Build Menu Object :
        $newItem = [
            'label' => $item_label,
            'path' => $item_path,
            'target' => $item_target,
            'child' => $item_child_menu
        ];
        
        // -- Mount Menu Object to Configuration :
        $configuration['nav'] = $this->config->addItemToMenu($item_parent,$newItem);

        // -- Save Configuration :
        $this->config->save($configuration);

        /**
         * Complete :
         */

    }

}