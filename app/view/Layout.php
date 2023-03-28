<!DOCTYPE html>

<html lang="pt-br"> 

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Kaue Henrique Domingues">
  <meta name="description" content="<?php echo $this->getDescription();?>">
  <meta name="keywords" content="<?php echo $this->getKeywords();?>">
  <title><?php echo $this->getTitle();?></title>
  <link rel="stylesheet" href="<?php echo DIRCSS.'/bootstrap.min.css';?>">
  <link rel="stylesheet" href="<?php echo DIRPAGE.'src/vendor/twbs/bootstrap-icons/font/bootstrap-icons.css';?>">
  <script src="<?php echo DIRJS.'/jquery-3.6.4.min.js';?>"></script>
  <script src="<?php echo DIRJS."/popper.min.js";?>"></script>
  <script src="<?php echo DIRJS.'/bootstrap.min.js';?>"></script>
  <script src="<?php echo DIRJS.'/home.js';?>"></script>
  <script src="<?php echo DIRPAGE.'src/vendor/components/jqueryui/jquery-ui.js';?>"></script>
  <link rel="stylesheet" href="<?php echo DIRCSS.'/estilo.css';?>"/>  
  <?php echo $this->addHead();?>
</head>

<body class="backgroundbody">

  <div class="Navbar">

  <?php echo $this->addNavBar();?>

  </div>
  <div class="Header">

    <?php echo $this->addHeader();?>

  </div>

  <div class="Main">

    <?php echo $this->addMain();?>
  
  </div>

  <div class="Footer">

    <?php echo $this->addFooter();?>
  
  </div>
  
</body>

</html>