<?php 

class Compiler {

    public function __construct(private $path, private $map = []){}

    public function Compile(){

        $pathRoutes = $this->CreatePaths($this->map);

        return json_encode($pathRoutes);

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


    private function CreatePaths($items, $paths = [] ){

        foreach($items as $obj){
            
            if( isset($obj['slug']) && $obj['slug'] !== false ){
                $paths[] = '/' . $obj['slug'];
                
            }else {
                $paths[] = '/';
            }
            
            // -- If there are children paths ::
            if(count($obj['items'])>0){
                $paths = $this->CreatePaths($obj['items'], $paths);
            }

        }

        return $paths;

    }


    private function Builder($obj){
        return 'building...';

    }

}