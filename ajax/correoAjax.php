<?php
$peticionAjax = true;

require_once "../core/config.php";
session_start();

require_once "../controller/CorreoController.php";
$inst = new CorreoController();

if (isset($_POST['datatable'])) {
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    echo $inst->listCorreoController($_REQUEST, $status);
}

if (isset($_POST['save'])) {
    echo $inst->saveCorreoController();
}

if (isset($_GET['btnActivaEliminar'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $status = isset($_GET['status']) ? $_GET['status'] : null;
    echo $inst->activaDeleteBrandController($id, $status);
}

if (isset($_POST['update'])) {
    echo $inst->updateCorreoController();
}

if (isset($_POST['enviar_publicitario'])) {
    echo $inst->enviarCorreoPublicitarioController();
}

 if (isset($_GET['evento'])) {
        echo $inst->getEMail($_GET['idEmail'] ); 
    }

// Nuevo bloque para manejar la petición de envío de prueba
if (isset($_POST['enviar_prueba'])) {
    $datos = array(
        'idEmail' => $_POST['idEmail'],
        'addressee' => $_POST['addressee'],
        'name' => $_POST['name'],
        'description' => $_POST['description']
    );

    $resultado = $inst->correoService->enviarMailPersonalizado($datos); // Utiliza la instancia del controlador

    if ($resultado['status']) {
        echo "Correo enviado correctamente.";
    } else {
        echo "Error al enviar el correo: " . $resultado['error'];
    }
} else {
    // Mantener la lógica de cierre de sesión para otras peticiones no manejadas
    if (!isset($_POST['save']) && !isset($_POST['datatable']) && !isset($_GET['btnActivaEliminar']) && !isset($_POST['update']) && !isset($_GET['formupdate']) && !isset($_GET['evento']) && !isset($_POST['enviar_publicitario'])) {
        session_destroy();
        echo '<script> window.location.href="' . SERVERURL . 'login/"</script>';
    }
}