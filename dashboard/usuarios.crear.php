<?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario'])){
    header('Location: ' . APP_URL . 'index.php');
    exit;
  }elseif($_SESSION['rol'] != 'ADMIN'){
    header('Location: ' . APP_URL . 'index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=APP_URL?>resources/css/flatly.min.css">
    <title>Crear Usuario</title>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>Formulario de registro</h2>
          <hr>
          <div class="well">
            <form class="form-horizontal" action="usuarios.crearSQL.php" method="post" autocomplete="off">
              <fieldset>

                <div class="form-group">
                  <label for="usuario" class="col-lg-2 control-label">Usuario</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="usuario" name="usuario" required autofocus>
                  </div>
                </div>

                <div class="form-group">
                  <label for="contrasenia" class="col-lg-2 control-label">Contraseña</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="contrasenia" name="contrasenia" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="rol" class="col-lg-2 control-label">ROL</label>
                  <div class="col-lg-10">
                    <select class="form-control" id="rol" name="rol">
                      <option value="USER">USER</option>
                      <option value="ADMIN">ADMIN</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Limpiar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
