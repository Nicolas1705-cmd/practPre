<?php

$peticionAjax=true;

require_once "../core/config.php";

if(isset($_POST['save']) || isset($_POST['datatable']) || isset($_GET['btnActivaEliminar']) ||
   isset($_POST['update']) || isset($_GET['formupdate']) ) // Asegúrate de que formupdate esté aquí
{

    require_once "../controller/MaterialController.php";
    $inst = new MaterialController();
    session_start();

    if (isset($_POST['datatable'])) {
        echo $inst->listMaterialController($_REQUEST,$_POST['status']);
    }

    if(isset($_GET['btnActivaEliminar'])){
        echo $inst->activaDeleteBrandController($_GET['id'],$_GET['status']);
    }

    if(isset($_POST['save'])){
        echo $inst->saveMaterialController();
    }

    if(isset($_POST['update'])){
        echo $inst->updateMaterialController();
    }

    // *** NUEVO: Llama a fomUpdate() cuando se solicita el formulario de actualización ***
    if(isset($_GET['formupdate'])){
        echo $inst->fomUpdate();
    }
    // *** FIN NUEVO ***

} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}