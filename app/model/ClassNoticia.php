<?php

  namespace App\Model;
  
  use App\Model\ClassConexao;


  class ClassNoticia extends ClassConexao{

    // Dados da noticia e db
    private $idNoticia, $titulo, $descricao, $imagem, $valid, $db;

    // Get and Set
    public function getIdNoticia() { return $this->idNoticia; }
    public function setIdNoticia($idNoticia) { $this->idNoticia = $idNoticia; }

    public function getTitulo() { return $this->titulo; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }

    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }

    public function getImagem() { return $this->imagem; }
    public function setImagem($imagem) { $this->imagem = $imagem; }

    // Deixa os dados em branco
    public function __construct(){

      $this->idNoticia="";
      $this->titulo="";
      $this->descricao="";
      $this->imagem="";

    }

    // Adiciona noticia
    public function adicionarNoticia(){


      // Valida se o dado esta correto
      if($this->titulo=="" || strlen($this->titulo)>100 || $this->descricao=="" || strlen($this->descricao)>400 || $this->imagem==""){

        return "erro1: Campos invalidos";

      }else{

        try{
          
          // Pesquisa o titulo ou imagem para verificar se n tem repitido
          $this->valid=$this->conexaoBd()->prepare("select idNoticia from tb_noticia where titulo=:titulo or imagem=:imagem");

          $this->valid->bindParam(":titulo", $this->titulo);
          $this->valid->bindParam(":imagem", $this->imagem["name"]);
          $this->valid->execute();

          $resultados=$this->valid->rowCount();

          // Verificando resultado
          if($resultados>0){

            return "erro2: Titulo ou imagem já existe";

          }else{
            
            // Upload da imagem
            if(move_uploaded_file($this->imagem["tmp_name"], DIRREQ."/public/img/".$this->imagem["name"])){
              
              // Realizando o insert no db
              $this->db=$this->conexaoBd()->prepare("insert into tb_noticia(titulo, descricao, imagem) Values(:titulo, :descricao, :imagem)");

              $this->db->bindParam(":titulo", $this->titulo, \PDO::PARAM_STR);
              $this->db->bindParam(":descricao", $this->descricao, \PDO::PARAM_STR);
              $this->db->bindParam(":imagem", $this->imagem['name'], \PDO::PARAM_STR);
              
              $this->db->execute();

              return "sucesso";

            }else{

              return "erro0: Tente novamente mais tarde";
            }

          }

        
        }catch(\PDOException $Erro){

          return "erro0: Tente novamente mais tarde";

        }
      }

    }

    // Função que lista as noticias
    public function listaNoticia(){

      // Verifica se tem titulo para pesquisar
      if($this->titulo!=""){

        $tituloLike="%".$this->titulo."%";

        $this->db=$this->conexaoBd()->prepare("select * from tb_noticia where titulo like :titulo");

        $this->db->bindParam(":titulo", $tituloLike, \PDO::PARAM_STR);
        $this->db->execute();
        
        $noticas=$this->db->fetchAll(\PDO::FETCH_ASSOC);

        if(count($noticas)>0){

          return $noticas;

        }else{

          return "notFund";

        }

        // Verifica se tem id para pesquisa
      }else if(!empty($this->idNoticia)){


        $this->db=$this->conexaoBd()->prepare("select * from tb_noticia where idNoticia = :idNoticia");

        $this->db->bindParam(":idNoticia", $this->idNoticia, \PDO::PARAM_INT);
        $this->db->execute();
        
        $noticas=$this->db->fetchAll(\PDO::FETCH_ASSOC);

        if(count($noticas)>0){

          return $noticas;

        }else{

          return "notFund";

        }
        
        // Retorna todos os valores
      }else{

        try{

          $this->db=$this->conexaoBd()->prepare("select * from tb_noticia");

          $this->db->execute();
          
          $noticas=$this->db->fetchAll(\PDO::FETCH_ASSOC);

          if(count($noticas)>0){

            return $noticas;

          }else{

            return "none";

          }

        }catch(\PDOException $Erro){

          return "erro0: Tente novamente mais tarde";

        }
      }
      
    }

    // Alterar noticia
    public function altNoticia(){


      // Valida se o dado esta correto
      if($this->titulo=="" || strlen($this->titulo)>100 || $this->descricao=="" || strlen($this->descricao)>400  || empty($this->idNoticia)){

        return "erro1: Campos invalidos";

      }else{

        try{
          
          // Pesquisa o titulo ou imagem para verificar se n tem repitido
          $this->valid=$this->conexaoBd()->prepare("select idNoticia from tb_noticia where (titulo=:titulo or imagem=:imagem) and idNoticia<>:idNoticia");

          $this->valid->bindParam(":titulo", $this->titulo);
          $this->valid->bindParam(":imagem", $this->imagem["name"]);
          $this->valid->bindParam(":idNoticia", $this->idNoticia, \PDO::PARAM_INT);
          $this->valid->execute();

          $resultados=$this->valid->rowCount();

          // Verificando resultado
          if($resultados>0){

            return "erro2: Titulo ou imagem já existe";

          }else{
            
            // Sem imagem
            if($this->imagem == "" || empty($this->imagem) || !isset($this->imagem["tmp_name"]) || !isset($this->imagem["name"])){

              $this->db=$this->conexaoBd()->prepare("UPDATE tb_noticia SET titulo = :titulo, descricao = :descricao WHERE idNoticia = :idNoticia");

              $this->db->bindParam(":titulo", $this->titulo, \PDO::PARAM_STR);
              $this->db->bindParam(":descricao", $this->descricao, \PDO::PARAM_STR);
              $this->db->bindParam(":idNoticia", $this->idNoticia, \PDO::PARAM_INT);
                
              $this->db->execute();

              return "sucesso";

              // Com imagem
            }else{
              // Upload da imagem
              if(move_uploaded_file($this->imagem["tmp_name"], DIRREQ."/public/img/".$this->imagem["name"])){
                
                $this->db=$this->conexaoBd()->prepare("select * from tb_noticia where idNoticia = :idNoticia");

                $this->db->bindParam(":idNoticia", $this->idNoticia, \PDO::PARAM_INT);
                $this->db->execute();
                
                $notica=$this->db->fetchAll(\PDO::FETCH_ASSOC);

                $imagemAntiga=$notica[0]["imagem"];
                
                // Se a imagem tiver o mesmo n exclui a imagem
                if($this->imagem["name"]!=$imagemAntiga){

                  unlink(DIRREQ."public/img/".$imagemAntiga);

                }else{

                  return "erro2: Titulo ou imagem já existe";

                }
                
                // Realiza o update no db
                $this->db=$this->conexaoBd()->prepare("UPDATE tb_noticia SET titulo = :titulo, descricao = :descricao, imagem = :imagem WHERE idNoticia = :idNoticia");

                $this->db->bindParam(":titulo", $this->titulo, \PDO::PARAM_STR);
                $this->db->bindParam(":descricao", $this->descricao, \PDO::PARAM_STR);
                $this->db->bindParam(":imagem", $this->imagem['name'], \PDO::PARAM_STR);
                $this->db->bindParam(":idNoticia", $this->idNoticia, \PDO::PARAM_INT);
                
                $this->db->execute();

                return "sucesso";

              }else{

                return "erro0: Tente novamente mais tarde";
              }

            }
          }
        
        }catch(\PDOException $Erro){

          return "erro0: Tente novamente mais tarde";

        }
      }

    }

    // Deletar noticia
    public function delNoticia(){
      
      // Verifica se o idNoticia e valido
      if(!empty($this->idNoticia) || $this->idNoticia!=""){

        $this->valid=$this->conexaoBd()->prepare("select idNoticia from tb_noticia where idNoticia=:idNoticia");

        $this->valid->bindParam(":idNoticia", $this->idNoticia, \PDO::PARAM_INT);

        $this->valid->execute();

        // Verifica se existe idNoticia
        if($this->valid->rowCount()>0){

          // Exclui a noticia
          $this->db=$this->conexaoBd()->prepare("delete from tb_noticia where idNoticia=:idNoticia");

          $this->db->bindParam(":idNoticia", $this->idNoticia, \PDO::PARAM_INT);

          $this->db->execute();

          return "sucesso";

        }else{

          return "erro0: Tente novamente mais tarde";

        }
      }else{

        return "erro0: Tente novamente mais tarde";

      }
    }

  }

?>
