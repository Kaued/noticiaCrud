<?php 

  namespace Src\Classes;

  class ClassRender{

    //Proprietates
    private $Dir;
    private $Title;
    private $Description;
    private $Keywords;
    private $ActiveNavBar=true;

  
    //Get e set
    public function getDir(){return $this->Dir;}
    public function setDir($Dir){$this->Dir = $Dir;}

    public function getActiveNavBar(){return $this->ActiveNavBar;}
    public function setActiveNavBar($ActiveNavBar){$this->ActiveNavBar = $ActiveNavBar;}

    public function getTitle(){return $this->Title;}
    public function setTitle($Title){$this->Title = $Title;}

    public function getDescription(){return $this->Description;}
    public function setDescription($Description){$this->Description = $Description;}

    public function getKeywords(){return $this->Keywords;}
    public function setKeywords($Keywords){$this->Keywords = $Keywords;}
    
    //Renderiza Layout
    public function renderLayout(){

      include_once(DIRREQ."app/view/Layout.php");

    }

    //Add Head especifico
    public function addHead(){

      if(file_exists(DIRREQ."app/view/{$this->getDir()}/head.php")){

        include(DIRREQ."app/view/{$this->getDir()}/head.php");
        
      }

    }

    //Add Header especifico 
    public function addHeader(){

      if(file_exists(DIRREQ."app/view/{$this->getDir()}/header.php")){

        include(DIRREQ."app/view/{$this->getDir()}/header.php");

      }

    }

    //Ativa ou desativa Navbar
    public function addNavBar(){

      $Navbar=$this->getActiveNavBar();

      if($Navbar==true){

        if(file_exists(DIRREQ."app/view/NavBar.php")){

          include(DIRREQ."app/view/NavBar.php");

        }
      }
    }

    //Add Main especifico
    public function addMain(){

      if(file_exists(DIRREQ."app/view/{$this->getDir()}/main.php")){

        include(DIRREQ."app/view/{$this->getDir()}/main.php");

      }

    }

    //Add Footer especifico
    public function addFooter(){

      if(file_exists(DIRREQ."app/view/{$this->getDir()}/footer.php")){

        include(DIRREQ."app/view/{$this->getDir()}/footer.php");

      }

    }
    
  }

?>