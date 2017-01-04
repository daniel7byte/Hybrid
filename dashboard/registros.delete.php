<?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');
  session_start();
  if(!isset($_SESSION['usuario'])){
    echo "Acceso denegado";
    exit;
  }elseif($_SESSION['rol'] != 'ADMIN'){
    echo "Acceso denegado";
    exit;
  }

  if(!isset($_POST['id'])){
	echo "false1";
  }else{

	if(empty($_POST['id'])){
		echo "false2";
	}else{
		$query = $mysql->prepare("SELECT * FROM registros WHERE id = :id");
		$query->execute([':id' => $_POST['id']]);
		$result = $query->rowCount();
		if($result == 1){
			$query = $mysql->prepare("DELETE FROM registros WHERE id = :id");
			$query->execute([
				':id' => $_POST['id']
			]);
			echo "true";
		}else{
			echo "false3";
		}
	}
  }
