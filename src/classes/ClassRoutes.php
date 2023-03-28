<?php

namespace Src\Classes;


use Src\Traits\UrlParse;

  
  class ClassRoutes{

    use UrlParse;

    private $Rotes;

    //Returna rote
    public function getRote(){

      $url=$this->parseUrl();
      $i=$url[0];

      //Routes
      $this->Rotes=array(

        ""=>"ControllerHome",
        "home"=>"ControllerHome",
        "adicionar"=>"ControllerAddNoticia",
        "adicionarNoticia"=>"ControllerAddNoticia",
        "add"=>"ControllerAddNoticia",
        "addNoticia"=>"ControllerAddNoticia",
        "noticia"=>"ControllerNoticia",
        "news"=>"ControllerNoticia"

      
      );

      if(array_key_exists($i, $this->Rotes)){

        if(file_exists(DIRREQ."app/controller/{$this->Rotes[$i]}.php")){

          return $this->Rotes[$i];

        }else{

          return "ControllerHome";

        }

      }else{

        return "ControllerHome";

      }

    }


  }

?>