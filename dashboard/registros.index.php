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
    <link rel="stylesheet" href="<?=APP_URL?>resources/datatables/css/jquery.dataTables.min.css">
    <title>Listado de documentos</title>
    <style media="screen">
      tfoot input {
        width: 99%;
		min-width: 60px;
        padding: 3px;
        box-sizing: border-box;
      }
    </style>
  </head>
  <body style="padding-top: 60px;">

    <?php include('layouts/navbar.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

		  <h2>Listado de documentos | <span><a style="border-radius: 10px;" class="btn btn-success btn-sm" href="<?=APP_URL?>dashboard/registros.crear.php">Crear Documento | <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></span></h2>

          <hr>
          <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
              <tr>
                <!--th>#</th-->
                <th>Fecha</th>
                <th>E/S</th>
                <th>T. Documento</th>
                <th>Consecutivo</th>
                <th>Ref</th>
                <th>Cant</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th>Descripcion</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Ref. Admin</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Contabilizado Admin</th>
                <?php } ?>

                <th>Error</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>F. Creacion</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN' OR $_SESSION['rol'] == 'USER'){ ?>
                  <th>ID. Usuario</th>
                <?php } ?>

                <th>Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!--th>#</th-->
                <th>Fecha</th>
                <th>E/S</th>
                <th>T. Documento</th>
                <th>Consecutivo</th>
                <th>Ref</th>
                <th>Cant</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th>Descripcion</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Ref. Admin</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>Contabilizado Admin</th>
                <?php } ?>

                <th>Error</th>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <th>F. Creacion</th>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN' OR $_SESSION['rol'] == 'USER'){ ?>
                  <th>ID. Usuario</th>
                <?php } ?>

                <th>Acciones</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
                #if($_SESSION['rol'] == 'ADMIN'){
                  $query = $mysql->prepare("SELECT * FROM registros ORDER BY id DESC");
                #}else{
                #  $query = $mysql->prepare("SELECT * FROM registros WHERE idUsuario = '".$_SESSION['id']."' ORDER BY id DESC");
                #}
                $query->execute();
                $rows = $query->fetchAll();
                foreach ($rows as $row) {
              ?>
              <tr>
                <!--td><?#=$row['id']?></td-->
                <td><?=$row['fechaManual']?></td>
                <td><?=$row['eS']?></td>
                <td><?=$row['tipoDocumento']?></td>
                <td><?=$row['consecutivoManual']?></td>
                <td>
				  <?php
					try {
					  $mysqlMEGA = new PDO('mysql:host=localhost;dbname=controlmega', 'root', '@Soporte7805');
					} catch (Exception $e) {
					  echo "Error: " . $e->getMessage();
					  exit;
					}
					$queryMEGADef = $mysqlMEGA->prepare("SELECT descripcion, referencia FROM articulos WHERE referencia = :ref");
					$queryMEGADef->execute([':ref' => $row['referencia']]);
					$resultMEGADef = $queryMEGADef->fetchAll();
					foreach ($resultMEGADef as $rowMEGADef) {
						echo $rowMEGADef['referencia'] . '(' . $rowMEGADef['descripcion'] . ')';
					}
				  ?>
				</td>
                <td><?=$row['cantidad']?></td>
                <td>
                  <?php
                    $queryProv = $mysqlMEGA->prepare("SELECT codproveedor, nombre, cifnif FROM proveedores WHERE codproveedor = :id");
                    $queryProv->execute([':id' => $row['proveedor']]);
                    $result = $queryProv->fetchAll();
                    foreach ($result as $rowProv) {
                      echo $rowProv['nombre'] . ' ['.$rowProv['cifnif'].']';
                    }
                  ?>
                </td>
                <td><?=$row['estado']?></td>
                <td><?=$row['descripcion']?></td>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                <td><?=$row['refAdmin']?></td>
                <?php } ?>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <td>
                    <?php if($row['contabilizadoAdmin']){?>
                      <span class="label label-sm label-success">SI <span class="glyphicon glyphicon-ok-sign"></span></span>
                    <?php }else{ ?>
                      <span class="label label-sm label-danger">NO <span class="glyphicon glyphicon-remove-sign"></span></span>
                    <?php } ?>
                  </td>
                <?php } ?>

                <td>
                  <?php if($row['error']){?>
                    <span class="label label-sm label-danger">SI <span class="glyphicon glyphicon-remove-sign"></span></span>
                  <?php }else{ ?>
                    <span class="label label-sm label-success">NO <span class="glyphicon glyphicon-ok-sign"></span></span>
                  <?php } ?>
                </td>

                <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                  <td><?=$row['fechaCreacion']?></td>
                <?php } ?>
                <?php if($_SESSION['rol'] == 'ADMIN' OR $_SESSION['rol'] == 'USER'){ ?>
                  <td>
                    <?php
                    $queryUser = $mysql->prepare("SELECT * FROM usuarios WHERE id = :id");
                    $queryUser->execute([':id' => $row['idUsuario']]);
                    $info = $queryUser->fetchAll();
                    foreach ($info as $key) {
                      echo $key['usuario'];
                    }
                    ?>
                  </td>
                <?php } ?>

                <td>
				  <button onclick="errorPost(<?=$row['id']?>);" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-warning-sign"></span></button>
                  <?php if($_SESSION['rol'] == 'ADMIN'){ ?>
                    <a href="<?=APP_URL?>dashboard/registros.editar.php?id=<?=$row['id']?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button onclick="deletePost(<?=$row['id']?>);" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="<?=APP_URL?>resources/js/jquery-1.12.3.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="<?=APP_URL?>resources/datatables/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#myTable tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
        } );

        // DataTable
        var table = $('#myTable').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );


		$( "input[placeholder|='Fecha']" ).attr('type', 'date');
		$( "input[placeholder|='F. Creacion']" ).attr('type', 'date');

    } );
    </script>
	
	
    <script>
  		function deletePost(idPost){
        if(confirm('¿Seguro que quiere eliminar este registro?')){
          $.ajax({
            // la URL para la petición
            url : 'registros.delete.php',

            // la información a enviar
            // (también es posible utilizar una cadena de datos)
            data : { id : idPost },

            // especifica si será una petición POST o GET
            type : 'POST',

            // el tipo de información que se espera de respuesta
            dataType : 'text',

            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success : function(json) {
              if(json == 'true'){
                alert('Documento eliminado');
                location.reload();
              }else{
                alert(json);
              }
            },

            // código a ejecutar si la petición falla;
            // son pasados como argumentos a la función
            // el objeto de la petición en crudo y código de estatus de la petición
            error : function(xhr, status) {
              alert('Disculpe, existió un problema');
            },

            // código a ejecutar sin importar si la petición falló o no
            complete : function(xhr, status) {
              console.log('Documento Eliminado');
            }
          });
        }
  		}
  	</script>
	
	<script>
  		function errorPost(idPost){
        if(true){
          $.ajax({
            // la URL para la petición
            url : 'registros.errorStatus.php',

            // la información a enviar
            // (también es posible utilizar una cadena de datos)
            data : { id : idPost },

            // especifica si será una petición POST o GET
            type : 'POST',

            // el tipo de información que se espera de respuesta
            dataType : 'text',

            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success : function(json) {
              if(json == 'true'){
                alert('Documento marcado como error');
                location.reload();
              }else{
                alert(json);
              }
            },

            // código a ejecutar si la petición falla;
            // son pasados como argumentos a la función
            // el objeto de la petición en crudo y código de estatus de la petición
            error : function(xhr, status) {
              alert('Disculpe, existió un problema');
            },

            // código a ejecutar sin importar si la petición falló o no
            complete : function(xhr, status) {
              console.log('Documento Eliminado');
            }
          });
        }
  		}
  	</script>
  </body>
</html>
