<?php

  namespace App\Controller;

  use App\Model\ClassNoticia;
  use Src\Classes\ClassRender;

    class ControllerNoticia extends ClassRender{

      //Dados da pagina home
      private $noticia, $idNoticia, $titulo, $descricao, $imagem;

      public function getNoticia() { return $this->noticia; }
      public function setNoticia($noticia) { $this->noticia = $noticia; }

      public function __construct(){

        $this->registerVarivel();
        $exibirNoticia= new ClassNoticia;

        $exibirNoticia->setIdNoticia($this->idNoticia);

        $this->setNoticia($exibirNoticia->listaNoticia());

        //Carrega informações da pagina
        $this->setTitle($this->noticia[0]["titulo"]);
        $this->setDescription("Leia algumas noticia");
        $this->setKeywords("noticia");
        $this->setDir("noticia/");   
        $this->renderLayout();  
        
      }
      
      //Pega as varieaveis
      public function registerVarivel(){

        if(isset($_POST['idNoticia'])){$this->idNoticia=filter_input(INPUT_POST, 'idNoticia');}

        if(isset($_POST['titulo'])){$this->titulo=filter_input(INPUT_POST, 'titulo');}
        
        if(isset($_POST['descricao'])){$this->descricao=filter_input(INPUT_POST, 'descricao');}

        if(isset($_POST['idNoticia'])){$this->idNoticia=filter_input(INPUT_POST, 'idNoticia');}
        
        if(isset($_FILES['imagem'])){$this->imagem=$_FILES['imagem'];}

      }

      // Metodo para alterar a noticia
      public function alterarNoticia(){

        $this->registerVarivel();
        
        $alterarNoticia= new ClassNoticia();

        // Passando os parametros
        $alterarNoticia->setDescricao($this->descricao);
        $alterarNoticia->setTitulo($this->titulo);
        $alterarNoticia->setImagem($this->imagem);
        $alterarNoticia->setIdNoticia($this->idNoticia);

        echo $alterarNoticia->altNoticia();


      }

      public function excluirNoticia(){

        $this->registerVarivel();

        $excluirNoticia= new ClassNoticia();

        $excluirNoticia->setIdNoticia($this->idNoticia);
        
        echo $excluirNoticia->delNoticia();
      }
    }

?>