<?php
$peticionAjax = true;

require_once "../core/config.php";
session_start();

if (isset($_POST['save']) || isset($_POST['datatable']) || isset($_GET['btnActivaEliminar']) || isset($_POST['update']) || isset($_GET['formupdate']) || isset($_GET['evento'])) {
    require_once "../controller/VehicleController.php";
    $inst = new VehicleController();

    if (isset($_POST['datatable'])) {
       
        $status = isset($_POST['status']) ? $_POST['status'] : null;
        echo $inst->listVehicleController($_REQUEST, $status);
    }

    if (isset($_POST['save'])) {
        echo $inst->saveVehicleController();
    }

    if (isset($_GET['btnActivaEliminar'])) {
      
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        echo $inst->activaDeleteBrandController($id, $status);
    }


 if (isset($_GET['evento'])) {
        echo $inst->getMOdelosVehiculos($_GET['idMarcaVehiculo'] ); 
    }

    if (isset($_POST['update'])) {
        echo $inst->updateVehicleController(); 
    }
} else {
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'login/"</script>';
}