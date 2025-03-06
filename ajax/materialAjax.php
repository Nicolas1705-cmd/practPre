<?php

$peticionAjax=true;

require_once "../core/config.php";

if(isset($_POST['save']) || isset($_POST['datatable']) || isset($_GET['btnActivaEliminar']) ||
 isset($_POST['update']) || isset($_GET['formupdate']) ){
	
require_once "../controller/MaterialController.php";
 $inst = new MaterialController();
    session_start();

if (isset($_POST['datatable'])) {
echo $inst->listMaterialController($_REQUEST,$_POST['status']);
}

	if(isset($_GET['btnActivaEliminar'])){
echo $inst->activaDeleteBrandController($_GET['id'],$_GET['status']);
	}
//este metodo sirve para redirigir los campos de texto a travez de su namehacia el controlador asignado 
	if(isset($_POST['save'])){
echo $inst->saveMaterialController();
	}

}else{
	session_start();
	session_destroy();
	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
	
}

