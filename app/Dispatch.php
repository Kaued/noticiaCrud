<?php

  namespace App;

  use Src\Classes\ClassRoutes;

  class Dispatch extends ClassRoutes{

    //Atributos
    private $Method;
    private $Param=[];
    private $Obj;

    //Get e Set Method
    public function getMethod(){return $this->Method;}
    public function setMethod($Method){$this->Method=$Method;}

    //Get e Set Param
    public function getParam(){return $this->Param;}
    public function setParam($Param){$this->Param=$Param;}

    //Metodo contrutuor 
    public function __construct()
    {
      self::addController();
    }
    
    //Add Controller
    private function addController(){

      $RotesController= $this->getRote();
      $nameS="App\\Controller\\{$RotesController}";

      $this->Obj=new $nameS;

      if(isset($this->parseUrl()[1])){
        
        self::addMethod();  

      }

    }

    //Add metodo Controller
    private function addMethod(){

      if(method_exists($this->Obj, $this->parseUrl()[1])){
        
        $this->setMethod("{$this->parseUrl()[1]}");
        self::addParam();
        call_user_func_array([$this->Obj,$this->getMethod()], $this->getParam());

      }

    }

    //Add metodo Parameter
    private function addParam(){

      $contArray=count($this->parseUrl());

      if($contArray>2){

        foreach($this->parseUrl() as $Key=>$value){

          if($Key>1){

            $this->setParam($this->Param += [$Key => $value]);
          }

        }
        
      }

    }
    
  }
?>