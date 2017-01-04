<?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario'])){
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
    <title>Editar Documento</title>
  </head>
  <body>
    <em>
      <?php
        $query = $mysql->prepare("UPDATE registros SET
          fechaManual = :fechaManual,
          eS = :eS,
          tipoDocumento = :tipoDocumento,
          consecutivoManual = :consecutivoManual,
          referencia = :referencia,
          cantidad = :cantidad,
          proveedor = :proveedor,
          estado = :estado,
          descripcion = :descripcion,
          refAdmin = :refAdmin,
          contabilizadoAdmin = :contabilizadoAdmin,
          error = :error
          WHERE id = :id");
        $query->execute([
          ':fechaManual' => $_POST['fechaManual'],
          ':eS' => $_POST['eS'],
          ':tipoDocumento' => $_POST['tipoDocumento'],
          ':consecutivoManual' => $_POST['consecutivoManual'],
          ':referencia' => $_POST['referencia'],
          ':cantidad' => $_POST['cantidad'],
          ':proveedor' => $_POST['proveedor'],
          ':estado' => $_POST['estado'],
          ':descripcion' => $_POST['descripcion'],
          ':refAdmin' => $_POST['refAdmin'],
          ':contabilizadoAdmin' => $_POST['contabilizadoAdmin'],
          ':error' => $_POST['error'],
          ':id' => $_POST['id']
        ]);
        echo "Editado!";
      ?>
      <script type="text/javascript">
        setTimeout(function(){ window.location = '<?=APP_URL?>dashboard/registros.index.php'; }, 1000);
      </script>
    </em>
    <script src="<?=APP_URL?>resources/js/jquery-3.1.1.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
