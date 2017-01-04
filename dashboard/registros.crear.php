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
    <link rel="stylesheet" href="<?=APP_URL?>resources/bootstrap-select/css/bootstrap-select.min.css">
    <title>Crear Documento</title>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
		      <h2>Formulario de registro | <span><a style="border-radius: 10px;" class="btn btn-success btn-sm" href="<?=APP_URL?>dashboard/registros.index.php">Listar Documentos | <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></span></h2>
          <hr>
          <div class="well">
            <form class="form-horizontal" action="registros.crearSQL.php" method="post" autocomplete="off">
              <fieldset>

                <div class="form-group">
                  <label for="fechaManual" class="col-lg-2 control-label">Fecha</label>
                  <div class="col-lg-10">
                    <input type="date" class="form-control" id="fechaManual" name="fechaManual" value="<?=date('Y-m-d')?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="eS" class="col-lg-2 control-label">Entrada/Salida</label>
                  <div class="col-lg-10">
                    <select class="form-control" id="eS" name="eS">
                      <option value="ENTRADA">ENTRADA</option>
                      <option value="SALIDA">SALIDA</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tipoDocumento" class="col-lg-2 control-label">Tipo de Documento</label>
                  <div class="col-lg-10">
                    <select class="form-control" id="tipoDocumento" name="tipoDocumento">
                      <option value="CXC">CXC</option>
                      <option value="DISTRIJUEGOS">DISTRIJUEGOS</option>
                      <option value="SIN IVA">SIN IVA</option>
                      <option value="FUERA INVENTARIO">FUERA INVENTARIO</option>
                      <option value="COMPRA">COMPRA</option>
                      <option value="DEVOLUCION">DEVOLUCION</option>
                      <option value="SIN FACTURA">SIN FACTURA</option>
                      <option value="SEPARADO">SEPARADO</option>
                      <option value="AVERIADO">AVERIADO</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="consecutivoManual" class="col-lg-2 control-label">Consecutivo</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="consecutivoManual" name="consecutivoManual" required autofocus>
                  </div>
                </div>

				<?php

					try {
					  $mysqlMEGA = new PDO('mysql:host=localhost;dbname=controlmega', 'root', '@Soporte7805');
					} catch (Exception $e) {
					  echo "Error: " . $e->getMessage();
					  exit;
					}

				?>

                <div class="form-group">
                  <label for="referencia" class="col-lg-2 control-label">Referencia</label>
                  <div class="col-lg-10">
                    <select class="selectpicker" data-style="btn-primary" data-live-search="true" id="referencia" name="referencia" data-size="10" data-width="auto" required>
                      <?php
                        $queryMEGA = $mysqlMEGA->prepare("SELECT descripcion, referencia FROM articulos ORDER BY referencia ASC");
                        $queryMEGA->execute();
                        $resultMEGA = $queryMEGA->fetchAll();
                        foreach ($resultMEGA as $rowMEGA) {
                      ?>
                        <option value="<?=$rowMEGA['referencia']?>"><?=$rowMEGA['referencia']?> (<?=$rowMEGA['descripcion']?>)</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="cantidad" class="col-lg-2 control-label">Cantidad</label>
                  <div class="col-lg-10">
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="proveedor" class="col-lg-2 control-label">Proveedor</label>
                  <div class="col-lg-10">

                    <select class="selectpicker" data-style="btn-primary" data-live-search="true" id="proveedor" name="proveedor" data-size="7" data-width="auto" required>
                      <?php
                        $queryProv = $mysqlMEGA->prepare("SELECT codproveedor, nombre, cifnif FROM proveedores ORDER BY nombre ASC");
                        $queryProv->execute();
                        $result = $queryProv->fetchAll();
                        foreach ($result as $row) {
                      ?>
                        <option value="<?=$row['codproveedor']?>"><?=$row['nombre']?> [<?=$row['cifnif']?>]</option>
                      <?php } ?>
                    </select>

                  </div>
                </div>

                <div class="form-group">
                  <label for="estado" class="col-lg-2 control-label">Estado</label>
                  <div class="col-lg-10">
                    <select class="form-control" id="estado" name="estado" required>
                      <option value="NO APLICA">NO APLICA</option>
                      <option value="PAGADO">PAGADO</option>
                      <option value="ABONADO">ABONADO</option>
                      <option value="PENDIENTE">PENDIENTE</option>
                      <option value="ANULADO">ANULADO</option>
                      <option value="DEVOLUCION">DEVOLUCION</option>
                      <option value="CRUCE DE CUENTAS">CRUCE DE CUENTAS</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="descripcion" class="col-lg-2 control-label">Descripcion</label>
                  <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="descripcion" name="descripcion"></textarea>
                  </div>
                </div>


                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                <div class="form-group">
                  <label for="refAdmin" class="col-lg-2 control-label">Referencia <span style="color: red;">ADMIN</span></label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="refAdmin" name="refAdmin">
                  </div>
                </div>
				<?php }else{ ?>
					<input type="hidden" class="form-control" id="refAdmin" name="refAdmin">
                <?php } ?>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                <div class="form-group">
                  <label for="contabilizadoAdmin" class="col-lg-2 control-label">Contabilidad <span style="color: red;">ADMIN</span></label>
                  <div class="col-lg-10">
                    <select class="form-control" id="contabilizadoAdmin" name="contabilizadoAdmin">
                      <option value="0" selected>Sin contabilizar</option>
                      <option value="1">Contabilizado</option>
                    </select>
                  </div>
                </div>
                <?php }else{ ?>
					<input type="hidden" class="form-control" id="contabilizadoAdmin" name="contabilizadoAdmin" value="0">
                <?php } ?>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                <div class="form-group" style="display: none;">
                  <label for="error" class="col-lg-2 control-label">Error <span style="color: red;">ADMIN</span></label>
                  <div class="col-lg-10">
                    <select class="form-control" id="error" name="error">
                      <option value="0" selected>Sin errores</option>
                      <option value="1">Con errores</option>
                    </select>
                  </div>
                </div>
                <?php }else{ ?>
					<input type="hidden" class="form-control" id="error" name="error" value="0">
                <?php } ?>

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
    <script src="<?=APP_URL?>resources/bootstrap-select/js/bootstrap-select.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap-select/js/i18n/defaults-es_ES.min.js" charset="utf-8"></script>
  </body>
</html>
