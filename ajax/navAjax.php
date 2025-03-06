<?php


$peticionAjax=true;

require_once "../core/config.php";

if( isset($_GET['btnActivaEliminar'])  || isset($_GET['listnot'])){
       session_start();

require_once "../controller/NavController.php";
 $inst = new NavController();


	if(isset($_GET['btnActivaEliminar'])){
echo $inst->activaDeleteNotifyController($_GET['id'],$_GET['status']);
	}

	
	if(isset($_GET['listnot'])){
echo $inst->listNotifyController();
	}

	
}else{
	session_start();
	session_destroy();
	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}


