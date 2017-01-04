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
  <body>
    <em>
      <?php
        $options = [
          'cost' => 12,
        ];
        $hash = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT, $options);

        $query = $mysql->prepare("INSERT INTO usuarios (usuario, contrasenia, rol) VALUES (:usuario, :contrasenia, :rol)");
        $query->execute([
          ':usuario' => $_POST['usuario'],
		  ':contrasenia' => $hash,
		  ':rol' => $_POST['rol']
        ]);
        echo "Usuario Registrado!";
      ?>
      <script type="text/javascript">
        setTimeout(function(){ window.location = '<?=APP_URL?>dashboard/usuarios.index.php'; }, 1000);
      </script>
    </em>
    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
