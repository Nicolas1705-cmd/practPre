<?php

$peticionAjax=true;

require_once "../core/config.php";

if(isset($_POST['save']) || isset($_POST['datatable']) || isset($_GET['btnActivaEliminar']) ||
 isset($_POST['update']) || isset($_GET['formupdate']) ){
	
	
require_once "../controller/VehicleController.php";
 $inst = new VehicleController();
    session_start();

if (isset($_POST['datatable'])) {
echo $inst->listVehicleController($_REQUEST,$_POST['status']);
}
if (isset($_POST['save'])) {
echo $inst->saveVehicleController();
}

	if(isset($_GET['btnActivaEliminar'])){
echo $inst->activaDeleteBrandController($_GET['id'],$_GET['status']);
	}

}else{
	session_start();
	session_destroy();
	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}