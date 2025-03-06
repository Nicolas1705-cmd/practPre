<?php


$peticionAjax=true;

require_once "../core/config.php";


if(isset($_POST['save']) || isset($_POST['datatable']) || isset($_GET['btnActivaEliminar']) ||
 isset($_POST['update']) || isset($_GET['formupdate']) ){
	
	
require_once "../controller/PlacasController.php";
 $inst = new PlacasController();
    session_start();

if (isset($_POST['datatable'])) {
echo $inst->listPlacaController($_REQUEST,$_POST['status']);
}

if(isset($_GET['formupdate'])){
	echo $inst->fomUpdate();
}

	if(isset($_GET['btnActivaEliminar'])){
echo $inst->activaDeleteBrandController($_GET['id'],$_GET['status']);
	}

 if(isset($_POST['save'])){
echo $inst->savePlacaController();	
	}
	 if(isset($_POST['update'])){
echo $inst->updatePlacaController();	
	}

}else{
	session_start();
	session_destroy();
	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}


