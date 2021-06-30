<?php

include_once __DIR__ . '/../../app/Support/Console/Console.php';
include_once __DIR__ . '/../../app/Support/Hash/Hash.php';
include_once __DIR__ . '/../../app/Config/Sitemap.php';


class CreatePage extends Console {

    public function __construct(public $input, public $title = 'Create New Page'){
        $this->desc($this->title);
        $this->config = new Sitemap('src');
        $this->hash = new Hash;
    }

    public function handle(){

        /**
         *  Start the build :::
         */
        $this->line('Creating a new page...');

        /**
         *  @ Get the configuration ::
         */
        $configuration = $this->config->get();

        /**
         *  @ Parse the input items :
         */
        if(
            !isset($this->input[1]) || 
            !isset($this->input[2]) || 
            !isset($this->input[3]) ||
            !isset($this->input[4]) ||
            !isset($this->input[5]) ||
            !isset($this->input[6]) 
        ){
            $this->error('Error: Missing arguments in command, expected 6. Name, Title, Slug, View, Type, Method. Exiting...');
            return;
        }

        // -- Page Name (Argument 1):
        $page_name = $this->input[1];

        // -- Page Title (Argument 2, needs quotes):
        $page_title = $this->input[2];

        // -- Page Slug (Argument 2):
        $page_slug = $this->input[3];

        // -- Page View (Argument 3):
        $page_view = $this->input[4];

        // -- Page Type (Argument 3, "static" or "fluid"):
        $page_type = $this->input[5];

        // -- Page Method (Argument 4, set "-" if static method):
        $page_method = $this->input[6];

        // -- Build Page Object :
        $newPage = [
            'id' => $this->hash->createObjHash(),
            'name' => $page_name,
            'title' => $page_title,
            'type' => $page_type,
            'slug' => $page_slug == '-' ? false : $page_slug,
            'view' => $page_view,
            'method' => $page_method == '-' ? false : $page_method,
            'items' => []
        ];

        // -- Add Menu to List :
        $pageList = $this->config->addPage($newPage);

        // -- Mount Menu Object to Configuration :
        $configuration['sitemap'] = $pageList;

        // -- Save Configuration :
        $this->config->save($configuration);

        /**
         * Complete :
         */

    }

}