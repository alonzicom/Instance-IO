<?php

include_once __DIR__ . '/Config/Sitemap.php';
include_once __DIR__ . '/Request/Router.php';
include_once __DIR__ . '/Controllers/Compiler.php';

class Kernel {

    public function __construct(){
        $this->Path = (new Router())->Get();
        $this->Sitemap = (new Sitemap)->map();
    }

    public function Build(){
        // -- Compile the website based on 
        // -- the public sitemap
        return $this->Compile('','build');
    }

    public function Run(){
        // -- Compile the single requested page,
        // -- based on the URI ::
        return $this->Compile($this->Path);
    }


    private function Compile($path, $type = 'view'){
        return 
            $type == 'view' ? 
                (new Compiler($path))->CompileView() : 
                (new Compiler(null,$this->Sitemap))->Compile();
    }

}