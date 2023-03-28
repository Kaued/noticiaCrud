<?php

  namespace App\Controller;

  use App\Model\ClassNoticia;
  use Src\Classes\ClassRender;

    class ControllerAddNoticia extends ClassRender{

      //Dados da pagina noticia
      private $titulo, $descricao, $imagem;


      public function __construct(){

        //Carrega informações da pagina
        $this->setTitle("Adicionar Noticias");
        $this->setDescription("Adicionar uma nova noticia");
        $this->setKeywords("add, adicionar");
        $this->setDir("addNoticia/");   
        $this->renderLayout();  

      }

      // Verifica se a imagem e valida
      private function ArquivoValido ($arquivo) {

        // O @ serve para suprimir os erros
        $image_info = @getimagesize($arquivo);
        return (bool) $image_info;

      }

      //Pega as varieaveis
      public function registerVarivel(){

        if(isset($_POST['titulo'])){$this->titulo=filter_input(INPUT_POST, 'titulo');}
        
        if(isset($_POST['descricao'])){$this->descricao=filter_input(INPUT_POST, 'descricao');}
        
        if(isset($_FILES['imagem'])){$this->imagem=$_FILES['imagem'];}

      }

      // MEtodo para adicionar uma nova noticia
      public function adicionar(){

        $this->registerVarivel();

        $addNoticia= new ClassNoticia();

        // Passando os parametros
        $addNoticia->setDescricao($this->descricao);
        $addNoticia->setTitulo($this->titulo);
        $addNoticia->setImagem($this->imagem);

        // Resposta
        echo $addNoticia->adicionarNoticia();
      
      }
    
    }

?>