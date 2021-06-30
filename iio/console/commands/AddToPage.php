<?php

include_once __DIR__ . '/../../app/Support/Console/Console.php';
include_once __DIR__ . '/../../app/Config/Sitemap.php';
include_once __DIR__ . '/../../app/Support/Hash/Hash.php';

class AddToPage extends Console {

    public function __construct(public $input, public $title = 'Add Item To Menu'){
        $this->desc($this->title);
        $this->config = new Sitemap('src');
        $this->hash = new Hash;
    }

    public function handle(){

        /**
         *  Start the build :::
         */
        $this->line('Adding Item to Existing Page...');

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

            // - Item Title :
            !isset($this->input[2]) ||

            // -- Item Slug :
            !isset($this->input[3]) ||

            // -- Item Type :
            !isset($this->input[4]) ||

            // -- Method :
            !isset($this->input[5]) ||

            // -- Parent (leave "-" if none) :
            !isset($this->input[6]) 

        ){
            $this->error('Error: Missing arguments in command, expected 6. Label, Title, Slug, Type, Method, Parent. Exiting...');
            return;
        }

        // -- Item Label :
        $item_name = $this->input[1];

        // -- Item Title :
        $item_title = $this->input[2];

        // -- Item Slug :
        $item_slug = $this->input[3];

        // -- Item Target :
        $item_type = $this->input[4] == '-' ? false : $this->input[4];

        $item_method = $this->input[5] == '-' ? false : $this->input[5];

        // -- Item Parent :
        $item_parent = $this->config->getIdByName($this->input[6]);

        // -- Build Menu Object :
        $newPage = [
            'id' => $this->hash->createObjHash(),
            'name' => $item_name,
            'title' => $item_title,
            'type' => $item_type,
            'slug' => $item_slug == '-' ? false : $item_slug,
            'method' => $item_method == '-' ? false : $item_method,
            'items' => []
        ];
        
        // -- Mount Menu Object to Configuration :
        $configuration['sitemap'] = $this->config->addItemToPage($item_parent,$newPage);

        // -- Save Configuration :
        $this->config->save($configuration);

        /**
         * Complete :
         */

    }

}