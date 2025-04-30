<?php
$peticionAjax = true;

require_once "../core/config.php";
session_start();

if (isset($_POST['save']) || isset($_POST['datatable']) || isset($_GET['btnActivaEliminar']) || isset($_POST['update']) || isset($_GET['formupdate']) || isset($_GET['evento'])) {
    require_once "../controller/EstablecimientoController.php";
    $inst = new EstablecimientoController();

    if (isset($_POST['datatable'])) {
       
        $status = isset($_POST['status']) ? $_POST['status'] : null;
        echo $inst->listEstablecimientoController($_REQUEST, $status);
    }

    if (isset($_POST['save'])) {
        echo $inst->saveEstablecimientoController();
    }

    if (isset($_GET['formupdate'])) {
        echo $inst->formupdate();
    }

    if (isset($_GET['btnActivaEliminar'])) {
      
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        echo $inst->activaDeleteBrandController($id, $status);
    }


if (isset($_GET['evento'])) {
    if (isset($_GET['idDepa'])) {
        echo $inst->getProvincias($_GET['idDepa']);
    } elseif (isset($_GET['idProv'])) {
        echo $inst->getDistritos($_GET['idProv']);
    }
}


    if (isset($_POST['update'])) {
        echo $inst->updateEstablecimientoController(); 
    }
} else {
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'login/"</script>';
}