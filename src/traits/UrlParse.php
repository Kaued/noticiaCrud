<?php

  namespace Src\Traits;

  //Divide url em uma array
  trait UrlParse{

    public function parseUrl(){

      return explode("/", rtrim($_GET['url']), FILTER_SANITIZE_URL);

    }
  }

?>