<div class="container">

  <div class="conteudo d-block">

    <!-- Título do container -->
    <div class="tituloAdd">

      Para criar um nova notícia preencha os campos

    </div>

    <!-- Formulario para adicionar noticia -->
    <div class="formAdd">
      
      <!-- Mensagem de erro -->
      <div class="alert alert-danger" role="alert" id="mensagemErroAdd"></div>
      

      <div class="imagensAddOrf">

        <p>Adicionar imagem:</p>
        <!-- Imagens -->
      <div class="mb-3 d-none">

        <label for="formFileMultiple" class="form-label">Adiconar imagens:</label>

        <input class="form-control" type="file" id="addImagens">

      </div>

      <button type="button" class="btn btn-secondary" id="imagensEditInput"><i class="bi bi-plus" aria-hidden="true"></i></button>

      <div class="imagensAdd" id="imagemAdicionadas">

      </div> 


      </div>
      <div class="informacaoAdd">

        <!-- Titulo -->
        <div class="form-floating mb-3">
          
          <input type="text" class="form-control" id="addTitulo" placeholder="Título">

          <label for="addTitulo">Título</label>

        </div>

        <!-- Descrição -->
        <div class="form-floating mb-3 h-75 ">
          
          <textarea type="text" class="form-control h-100" id="addDescricao" placeholder="Descrição"></textarea>

          <label for="addDescrição">Descrição</label>

        </div>

      </div>
       

      <div class="botaoAdd">

        <button type="button" class="btn btn-danger" id="cancelarAdd">Cancelar</button>

        <button type="button" class="btn btn-success" id="adicionarNoticia">Salvar</button>

      </div>

    </div>

  </div>

</div>