<?php

  namespace App\Controller;

  use App\Model\ClassNoticia;
  use Src\Classes\ClassRender;

    class ControllerHome extends ClassRender{

      //Dados da pagina home
      private $pesquisa;

      public function __construct(){

        //Carrega informações da pagina
        $this->setTitle("Home");
        $this->setDescription("Pagina principal");
        $this->setKeywords("pagina principal");
        $this->setDir("home/");   
        $this->renderLayout();  
        
      }
      
      //Pega as varieaveis
      public function registerVarivel(){

        if(isset($_POST['pesquisa'])){$this->pesquisa=filter_input(INPUT_POST, 'pesquisa');}

      }

      // Lista as noticias, caso haja a pesquisa que 
      public function listarNoticias(){

        // Pega a pesquisa casos exista
        $this->registerVarivel();

        $agenda= new ClassNoticia;

        // Se existe pesquisa manda para titulo para pesquisar
        if(!empty($this->pesquisa)){

          $agenda->setTitulo($this->pesquisa);
          
        }

        // Realiza a pesquisa
        $reposta=$agenda->listaNoticia();
        
        // Se não existe noticia
        if($reposta=="none"){

            echo('<div class="semNoticia">

            <p>Não existe nenhuma noticia criada!</p>
            <a href="'.DIRPAGE."add".'">Criar</a>
          
      
          </div>');
          
        }else if(is_string($reposta)){

          if(strpos($reposta, "erro0")){
          echo('<div class="semNoticia">

            <p>Tente novamente mais tarde</p>

          </div>');
          }else if($reposta=="notFund"){

            echo '<div class="semNoticia">

            <p>Não foi encontrada nenhuma noticia!</p>

          </div>';

          }
        }else{

          // Prepara para receber noticia
          echo "<div class='noticiaList'>";

          // Se for pesquisa exibe este titulo
          if(!empty($this->pesquisa)){

            echo "<h1>Resultado das pesquisa</h1>";

          }else{
            
            echo "<h1>Ultimas Notícias</h1>";

          }
          // Para cada noticia adicona a noticia no card
          foreach($reposta as $noticia){

            if(strlen($noticia["descricao"])>100){

              $resumoDesc=substr($noticia["descricao"], 0 , 100)."...";

            }else{

              $resumoDesc=$noticia["descricao"];

            }

            echo " <div class='card mb-3'>
            <div class='row g-0'>
              <div class='col-md-2 d-flex align-items-center justify-content-center'>
                <img src='".DIRIMG."/".$noticia["imagem"]."' alt='".$noticia["titulo"]."'>
              </div>
              <div class='col-md-8'>
                <div class='card-body'>
                  <h5 class='card-title'>".$noticia["titulo"]."</h5>
                  <p class='card-text'>".$resumoDesc."</p>
                  <p class='card-text'><form method='POST' action='noticia'><input type='text' class='d-none' value='".$noticia["idNoticia"]."' name='idNoticia'><button type='submit' class='btn btn-info btnlink'>Mais</button></form></p>
                </div>
              </div>
            </div>
            </div>";

          }

          echo"</div>";
        }
      }
    
    }

?>