<?php

namespace App\Model;


class ClassConexao{


  public function conexaoBd(){

    try{

      $con= new \PDO("mysql:host=".HOST.";dbname=".DB."","".USER."","".PASS."");

      return $con;

    }catch(\PDOException $Erro){

      return "erro0: Tente novamente mais tarde";

    }

  }
}

?>