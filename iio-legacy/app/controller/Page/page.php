<?php

// -- @@ Navigation Controller :
require_once( IIO . 'app/controller/Nav/nav.php');

// -- @@ Components Controller :
require_once( IIO . 'app/controller/Component/components.php');

class PAGE {

    public function __construct($page,$config){
      $this->dom = new DOMDocument();
      $this->render = $this->Parse($page,$config);
    }

    public function __toString(){
      return $this->render;
    }


    private function Parse($page,$config){

      $var = $config['iio-comp-var'];
      $template = $config['assets-route'];
      $is = $config['iio-start'];
      $ie = $config['iio-end'];

      $render = new COMPONENTS;
      $dom = new DOMDocument();

      $componentAttributes = [];
      @$dom->loadHTML($page);

      $filterTags = ["html","body","iio"];

      foreach($dom->getElementsByTagName('*') as $element){
          
          // -- This gets the contents of tag:
          //$element->nodeValue;
          $thisComponentAttributes = [];

          if(!in_array($element->tagName,$filterTags)){
            if($element->hasAttributes()){
              foreach ($element->attributes as $attr) {
                $thisComponentAttributes[] = [
                  $attr->nodeName => $attr->nodeValue
                ];
              }
            }

            $componentAttributes[$element->tagName] = $thisComponentAttributes;

          }
    
      }

      $componentArrays = $componentAttributes;
      $components = array_keys($componentAttributes);

      $count = count($components);

      $comp = [];
      $page = '';
      $styles = '';

      for($c=0;$c<$count;$c++){

        $thisComponent = $components[$c];

        // -- This Needs to Render the Component Vars :
        $compVars = $componentArrays[$thisComponent];
        $varCount = count($compVars);

        
        if($thisComponent == 'section'){
            $thisComponent = $thisComponent . '/' . $componentArrays[$thisComponent][0]['id'];
        }

        // -- Get Contents of this Component :
        $component = file_get_contents( IIO . 'components/'.$thisComponent.'.html');

        // -- Get Component Style :
        $component = $render->cleanStyle($component);

        for($v=0;$v<$varCount;$v++){

          $thisVarKey = key($compVars[$v]);
          $thisVarValue = $compVars[$v][$thisVarKey];

          // -- Replace Page Variables with Data/Content :
          $component = str_replace($is.$thisVarKey.$ie, $thisVarValue, $component);

        }

        // -- Return Cleaned Component :
        $page .= $component;

      }


      // TODO: Create function :
      //
      $page = str_replace($is.'assets-route'.$ie, $template, $page);

      // -- Render All Navs:
      $navs = $config['nav'];
      $navs_count = count($navs);
      $nav_slug = array_keys($navs);
      for($n=0;$n<$navs_count;$n++){
        $nav_name = $nav_slug[$n];
        $page = str_replace($is.'nav:'.$nav_name.$ie, new NAV($config,$nav_name), $page);
      }

      $vars = $config['vars'];
      $var_count = count($vars);

      for($v=0;$v<$var_count;$v++){
        // -- Replace Page Variables with Data/Content :
        $page = str_replace($is.$vars[$v]['name'].$ie, $vars[$v]['data'], $page);
      }

      // -- This will need to be extended :
      $page = $render->cleanTags($page,$is,$ie);

      // -- Return Rendered Page :
      return $page;


    }






}
