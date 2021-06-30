<?php 

class Compiler {

    public function __construct(private $path, private $map = []){}

    public function Compile(){

        foreach($this->map as $obj){

            /**
             *  Need to parse the sitemap objects :
             */
            $this->Builder($obj);
        }
    }

    public function CompileView(){
        return $this->Builder($this->path);
    }


    private function Builder($obj){
        return 'building...';

    }

}