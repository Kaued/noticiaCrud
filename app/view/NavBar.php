<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Pouco Minuto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo DIRPAGE."home";?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo DIRPAGE."adicionarNoticia";?>">Adicionar Notícia</a>
        </li>
      </ul>
      <form class="d-flex" role="search" method="POST" action="home">
        <input class="form-control me-2" type="search" placeholder="Pesquisa" aria-label="pesquisa" id="pesquisa" name="pesquisa">
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
      </form>
    </div>
  </div>
</nav>