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
            !isset($this->input[5])
        ){
            $this->error('Error: Missing arguments in command, expected 4. Name, Title, Slug, Type, Method. Exiting...');
            return;
        }

        // -- Page Name (Argument 1):
        $page_name = $this->input[1];

        // -- Page Title (Argument 2, needs quotes):
        $page_title = $this->input[2];

        // -- Page Slug (Argument 2):
        $page_slug = $this->input[3];

        // -- Page Type (Argument 3, "static" or "fluid"):
        $page_type = $this->input[4];

        // -- Page Method (Argument 4, set "-" if static method):
        $page_method = $this->input[5];

        // -- Build Page Object :
        $newPage = [
            'id' => $this->hash->createObjHash(),
            'name' => $page_name,
            'title' => $page_title,
            'type' => $page_type,
            'slug' => $page_slug == '-' ? false : $page_slug,
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