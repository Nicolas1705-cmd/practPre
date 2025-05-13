<?php
$peticionAjax = true;

require_once "../core/config.php";
session_start();

if (isset($_POST['save']) || isset($_POST['datatable']) || isset($_GET['btnActivaEliminar']) || isset($_POST['update']) || isset($_GET['formupdate']) || isset($_GET['evento']) || isset($_GET['action'])) {
    require_once "../controller/CombustibleController.php";
    $inst = new CombustibleController();

    if (isset($_POST['datatable'])) {

        $status = isset($_POST['status']) ? $_POST['status'] : null;
        echo $inst->listCombustibleController($_REQUEST, $status);
    }

    if (isset($_POST['save'])) {
        echo $inst->saveCombustibleController();
    }

    if (isset($_GET['formupdate'])) {
        echo $inst->formupdate();
    }

    if (isset($_GET['btnActivaEliminar'])) {

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        echo $inst->activaDeleteBrandController($id, $status);
    }

    if (isset($_POST['update'])) {
        echo $inst->updateCombustibleController();
    }

    if (isset($_GET['action'])) {
        require_once "../controller/HomeController.php";
        $homeInst = new HomeController();
        switch ($_GET['action']) {
            case 'gastoMensual':
                if (isset($_GET['anio'])) {
                    echo json_encode($homeInst->obtenerGastoTotalMensualCombustibleController($_GET['anio']));
                } else {
                    echo json_encode($homeInst->obtenerGastoTotalMensualCombustibleController());
                }
                break;
            case 'gastoMensualActual':
                echo json_encode($homeInst->obtenerTotalGastoMesActual());
                break;
            case 'vehiculoEficiente':
                echo json_encode($homeInst->obtenerVehiculoMasEficienteController($_GET['periodo'] ?? 'month'));
                break;
            case 'alertasAnomalias':
                echo json_encode($homeInst->obtenerAlertasRendimientoAnomaloController(20, $_GET['periodo'] ?? 'month'));
                break;
            case 'alertasAnomaliasCount':
                echo json_encode($homeInst->obtenerNumAlertasRendimientoAnomaloMesActual());
                break;
            // ... otros casos del controlador de combustible si los tuvieras ...
        }
    }

} else {
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'login/"</script>';
}