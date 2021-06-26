<?php

include_once __DIR__ . '/Request/Router.php';

class Kernel {

    public function __construct(){
        $this->Path = (new Router())->Get();
    }

    public function Build(){
        return 'building...';
    }

    public function Run(){

        // -- Compile the single requested page,
        // -- based on the URI ::
        return 
            $this->Compile(
                $this->Path
        );
    
    }


    private function Compile($path){
        return $path[0];
    }

}