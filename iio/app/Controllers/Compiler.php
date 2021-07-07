<?php 


class Compiler {

    public function __construct(private $path, private $map = []){
        $this->Hash = new Hash;
    }

    public function Compile(){

        $pathRoutes = $this->pathCreator();
        
        foreach($pathRoutes as $obj){

            // -- Explode path into array parts ::
            $obj = explode('/', $obj);

            // -- Remove first "blank" part ::
            array_shift($obj);

            // -- Build Path :: 
            $this->Builder($obj);
        }

    }

    public function CompileView(){
        return $this->Builder($this->path);
    }

    private function pathCreator(){

        $pathRoutes = $this->pathStringer();
        $routes = [];

        array_walk_recursive(
            $pathRoutes,
            function (&$value) use (&$routes) {
                $routes[] = $value;
            }
        );

        return $routes;
    }

    private function pathStringer($items = [], $prefix = null){

        $items = empty($items) ? $this->map : $items;

        foreach($items as $item){
            $slug = '';
            $slug = ($prefix ?? '') . '/' . $item['slug'];
            $routes[] = $slug;
            if(!empty($item['items'])){
                $routes[] = $this->pathStringer($item['items'], $slug);
            }
        }

        return $routes;
    }


    /**
     *  ! - This handles the IIO Build Compiler :: 
     */
    private function Builder($obj){

        echo 'Building: ' . json_encode($obj) . "\n\n";

    }

}