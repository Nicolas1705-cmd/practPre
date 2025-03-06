<?php


$peticionAjax=true;

require_once "../core/config.php";

if(isset($_POST['login']) || isset($_GET['salir'])){
	
require_once "../controller/LoginController.php";
 $inst = new LoginController();
	if(isset($_POST['login'])){
$inst->signInController();	
	}
	if (isset($_GET['salir'])) {
	echo $inst->sessionDistroy();
}




}else{

if (isset($_COOKIE["AdminPretyrose"])) {
	unset($_COOKIE["idAdminPretyrose"]);
 setcookie('idAdminPretyrose', null, -1, '/');
 unset($_COOKIE["AdminPretyrose"]);
 setcookie('AdminPretyrose', null, -1, '/');
 unset($_COOKIE["rolAdminPretyrose"]);
 setcookie('rolAdminPretyrose', null, -1, '/');
  unset($_COOKIE["idrolAdminPretyrose"]);
 setcookie('idrolAdminPretyrose', null, -1, '/');

}
	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}

