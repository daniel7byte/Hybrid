<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Hybrid</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?=APP_URL?>">Inicio <span class="sr-only">(current)</span></a></li>
        <?php
          if($_SESSION['rol'] == 'ADMIN'){
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=APP_URL?>dashboard/usuarios.index.php">Listar</a></li>
            <li><a href="<?=APP_URL?>dashboard/usuarios.crear.php">Crear</a></li>
          </ul>
        </li>
        <?php } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Documentos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=APP_URL?>dashboard/registros.index.php">Listar</a></li>
            <li><a href="<?=APP_URL?>dashboard/registros.crear.php">Crear</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="<?=APP_URL.'auth/logout.php'?>"><?=$_SESSION['usuario']?> | Salir</a></li>
      </ul>
    </div>
  </div>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-72526261-2', 'auto');
	  ga('send', 'pageview');

	</script>
</nav>
