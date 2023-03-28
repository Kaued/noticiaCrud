<?php

  //Root arquivos diretorios

  $InternalFolder="noticiaCrud/";

  //DIRPAGE
  define("DIRPAGE", "http://{$_SERVER['HTTP_HOST']}/{$InternalFolder}");

  //DIRREQUESt
  if(substr($_SERVER['DOCUMENT_ROOT'], -1)=='/'){define("DIRREQ", "{$_SERVER['DOCUMENT_ROOT']}{$InternalFolder}");}else{define("DIRREQ", "{$_SERVER['DOCUMENT_ROOT']}/{$InternalFolder}");}

  //Specifc Directory
  define("DIRIMG", DIRPAGE."public/img");
  define("DIRCSS", DIRPAGE."public/css");
  define("DIRJS", DIRPAGE."public/js");
  define("DIRVEN", DIRPAGE."src/vendor  ");

  //BD Directory
  define("HOST", "localhost");
  define("DB", "bd_noticia");
  define("USER", "root");
  define("PASS", "");
  
?>