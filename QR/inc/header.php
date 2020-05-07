<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APP QR | ADMINISTRACIÓN</title>
    <link rel="shortcut icon" href="../../QR/inc/img/favicon.png">
<!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
-->
    <link rel="stylesheet" href="../../QR/inc/css/bootstrap.min.css">

    <style>
		body  {
			background-image: url("../../QR/inc/img/wallpaper.png"); /* The image used */
    	}
	</style>
</head>
<body>
<!--<body background="http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/dark_embroidery.png">-->
<?php if(isset($_SESSION['administrador'])): ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <a class="navbar-brand" href="<?php echo urlsite ?>">APP QR </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">  	
	    <ul class="navbar-nav">
<!--		
		<li class="nav-item">
	        <a class="nav-link" href="?pagina=index">HOME</a>
	      </li>
-->
	      <li class="nav-item">
	        <a class="nav-link" href="?pagina=productos">PRODUCTO</a>
	      </li>
<!--
	      <li class="nav-item">
	        <a class="nav-link" href="?pagina=promociones">PROMOCIONES</a>
	      </li>
-->
	      <li class="nav-item">
	        <a class="nav-link" href="?pagina=inventario">INVENTARIO</a>
	      </li>
	      <li class="nav-item">
	      	<a class="nav-link" href="?pagina=registro">REGISTRO</a>
	      </li>	      
	    </ul>
		<ul class="navbar-nav ml-auto">	      
	      <li class="nav-item">
	        <a class="nav-link" href="<?php echo urlsite ?>procesos/logout.php">CERRAR SESIÓN</a>
	      </li>
	    </ul>
	</div>
</div>
</nav>
<?php endif;?>