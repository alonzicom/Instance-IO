<?php

class Router {

  public function Get(){

    // -- Get URI and create array:
    $u = explode('/', $_SERVER['REQUEST_URI']);

    // -- Remove the first item in the array :
    array_shift($u);

    return $u;

  }


}