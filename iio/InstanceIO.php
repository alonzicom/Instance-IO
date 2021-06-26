<?php 

include_once __DIR__ . '/app/Kernel.php';

class IIO {

    public function __construct(public $type){
        $this->Kernel = new Kernel;
    }

    public function Go(){
        return $this->type == 'static' ? $this->Kernel->Build() : $this->Kernel->Run();
    }

}
