<div class="container">

  <div class="modal fade" id="excluirNoticia" tabindex="-1" aria-labelledby="excluirNoticiaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="excluirNoticiaLabel">Excluir <?php echo $this->getNoticia()[0]["titulo"]; ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Você realmente deseja excluir a notícia <?php echo $this->getNoticia()[0]["titulo"]; ?>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="btnExcluirNoticia">Excluir</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Alterar modal -->
  <div class="modal fade" id="editarNoticia" tabindex="-1" aria-labelledby="editarNoticiaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editarNoticiaTitulo">Editar noticia: <?php echo $this->getNoticia()[0]["titulo"];?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="formAdd">
      
      <!-- Mensagem de erro -->
      <div class="alert alert-danger" role="alert" id="mensagemErroAlterar"></div>
      

      <div class="imagensAddOrf">

        <p>Adicionar imagem:</p>
        <!-- Imagens -->
      <div class="mb-3 d-none">

        <label for="formFileMultiple" class="form-label">Adiconar imagens:</label>

        <input class="form-control" type="file" id="alterarImagem">

      </div>

      <button type="button" class="btn btn-secondary" id="imagensEditInput"><i class="bi bi-plus" aria-hidden="true"></i></button>

      <div class="imagensAdd" id="imagemAdicionadas">

      <img src='<?php echo DIRIMG."/".$this->getNoticia()[0]["imagem"];?>'>
      </div> 


      </div>
      <div class="informacaoAdd">

        <!-- Titulo -->
        <div class="form-floating mb-3">
          
          <input type="text" class="form-control" id="alterarTitulo" placeholder="Título" value="<?php echo $this->getNoticia()[0]["titulo"];?>">

          <input type="text" class="form-control d-none" id="idNoticia" placeholder="idNoticia" value="<?php echo $this->getNoticia()[0]["idNoticia"];?>" disabled>

          <label for="alterarTitulo">Título</label>

        </div>

        <!-- Descrição -->
        <div class="form-floating mb-3 h-75 ">
          
          <textarea type="text" class="form-control h-100" id="alterarDescricao" placeholder="Descrição"><?php echo $this->getNoticia()[0]["descricao"];?></textarea>

          <label for="alterarDescricao">Descrição</label>

        </div>

      </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelarAlteracao">Cancelar</button>
          <button type="button" class="btn btn-primary" id="alterarNoticia">Salvar Alteração</button>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="conteudo">

    <div class="noticiaExibir">

      <div class="botaoNoticia" aria-label="Excluir e editar">

          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirNoticia"><i class="bi bi-trash" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarNoticia"><i class="bi bi-pencil" aria-hidden="true"></i></button>
          
      </div>

      <h1><?php echo $this->getNoticia()[0]["titulo"];?></h1>
      <img src='<?php echo DIRIMG."/".$this->getNoticia()[0]["imagem"];?>' class="d-block w-100">

      <p>
        
        <?php echo nl2br($this->getNoticia()[0]["descricao"]);?>

      </p>



</div>