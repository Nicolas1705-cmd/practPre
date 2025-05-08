<?php 
//session_start();
if ($peticionAjax) {
    require_once "../model/CombustibleModel.php";
} else {
    require_once "./model/CombustibleModel.php";
}

class CombustibleController extends CombustibleModel {

    public function listCombustibleController($request, $status) {
    $cnn = mainModel::conect();
    $btn = ($status == 1) ? "danger" : "success";
    $icon = ($status == 1) ? "trash fa-lg" : "check fa-lg";

    $col = array(0 => 'idCombustible', 1 => 'name', 2 => 'nombre_choferes', 3 => 'nombre_vehicle', 4 => 'kilometraje', 5 => 'cantidad', 6 => 'monto', 7 => 'tipoCombustible', 8 => 'estacionServicio', 9 => 'comprobanteURL', 10 => 'dateRegister');
    $index = ($request['order'][0]['column'] != 5) ? $request['order'][0]['column'] : 0;

    $sql = "SELECT SQL_CALC_FOUND_ROWS tcombustible.*, 
                   tchoferes.name AS nombre_choferes,
                   tvehiculos.name AS nombre_vehicle
            FROM tcombustible 
            INNER JOIN tchoferes ON tcombustible.idChoferes = tchoferes.idChoferes 
            INNER JOIN tvehiculos ON tcombustible.idVehiculos = tvehiculos.idVehiculos
            WHERE tcombustible.status = :status";

    $query = $cnn->prepare($sql);
    $query->bindParam(':status', $status);
    $query->execute();

    if (!empty($request['search']['value'])) {
        $sql .= " AND name LIKE :search";
        $query = $cnn->prepare($sql);
        $searchValue = "%" . $request['search']['value'] . "%";
        $query->bindParam(':search', $searchValue);
        $query->bindParam(':status', $status);
        $query->execute();
    }

    $totalData = $cnn->query("SELECT FOUND_ROWS()")->fetchColumn();

    if (isset($request['order'])) {
        $sql .= " ORDER BY " . $col[$index] . " " . $request['order'][0]['dir'] . " LIMIT :start, :length";
        $query = $cnn->prepare($sql);
        $query->bindParam(':start', $request['start'], PDO::PARAM_INT);
        $query->bindParam(':length', $request['length'], PDO::PARAM_INT);
        $query->bindParam(':status', $status);
        $query->execute();
    }

    $data = array();
    $contador = 0;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $subdata = array();
        $contador++;
        $encryp = mainModel::encryption($row['idCombustible']);
        $row['idCombustible'] = $encryp;
        $subdata[] = $contador;
        $subdata[] = $row['name'];
        $subdata[] = $row['nombre_choferes'];
        $subdata[] = $row['nombre_vehicle'];
        $subdata[] = $row['kilometraje'];
        $subdata[] = $row['cantidad'];
        $subdata[] = $row['monto'];
        $subdata[] = $row['tipoCombustible'];
        $subdata[] = $row['estacionServicio'];
        $subdata[] = $row['comprobanteURL'];
        $subdata[] = $row['dateRegister'];

        $operacionescrud = "<a onclick='rellEditV2(`".$encryp."`,`".'combustibleAjax'."`,`".SERVERURL."`,`idCombustible`)' class='btn btn-primary btn-xs  mr-xs' data-toggle='modal' data-target='#modalesForm'><i class='fa-regular fa-pen-to-square'></i></a>";
        $operacionescrud .= "<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'combustibleAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-" . $btn . " btn-xs '> <i class='fa fa-" . $icon . "'></i></button>";

        $subdata[] = $operacionescrud;
        $data[] = $subdata;
    }

    $json_data = array(
        "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalData),
        "data" => $data
    );
    return json_encode($json_data);
}

    public function activaDeleteBrandController($idElemento, $status) {
        $idElemento = mainModel::limpiar_cadena($idElemento);
        $idElemento = mainModel::decryption($idElemento);
        if ($idElemento != false) {
            $status = mainModel::limpiar_cadena($status);
            if (mainModel::activateDeleteSimple("tcombustible", $idElemento, $status, "idCombustible")) {
                if ($status == 1) {
                    $msg = ["alert" => "delete"];
                } else {
                    $msg = ["alert" => "activate"];
                }
            } else {
                $msg = ["alert" => "error"];
            }
        } else {
            $msg = ["alert" => "error"];
        }
        return mainModel::mensajeRespuesta($msg);
    }

    public function fomUpdate() {
        $idCombustible = mainModel::limpiar_cadena($_GET['idCombustible']);
        $idCombustible = mainModel::decryption($idCombustible);

        $consulta = mainModel::execute_query("SELECT * FROM tcombustible WHERE idCombustible = $idCombustible");
        $req = $consulta->fetch(PDO::FETCH_ASSOC);
        $cuerpo = ' <script> 
$(".name").val("' . $req['name'] . '");
$(".idChoferes").val("' . $req['idChoferes'] . '");
$(".idVehiculos").val("' . $req['idVehiculos'] . '");
$(".kilometraje").val("' . $req['kilometraje'] . '");
$(".cantidad").val("' . $req['cantidad'] . '");
$(".monto").val("' . $req['monto'] . '");
$(".tipoCombustible").val("' . $req['tipoCombustible'] . '");
$(".estacionServicio").val("' . $req['estacionServicio'] . '");
$(".comprobanteURL").val("' . $req['comprobanteURL'] . '");

</script>';
        return $cuerpo;
    }

    public function updateCombustibleController() {
        $idCombustible = mainModel::limpiar_cadena($_POST['idCombustible']);
        $idCombustible = mainModel::decryption($idCombustible);
        $name = mainModel::limpiar_cadena($_POST['name']);
        $idChoferes = mainModel::limpiar_cadena($_POST['idChoferes']);
        $idVehiculos = mainModel::limpiar_cadena($_POST['idVehiculos']);
        $kilometraje = mainModel::limpiar_cadena($_POST['kilometraje']);
        $cantidad = mainModel::limpiar_cadena($_POST['cantidad']);
        $monto = mainModel::limpiar_cadena($_POST['monto']);
        $tipoCombustible = mainModel::limpiar_cadena($_POST['tipoCombustible']);
        $estacionServicio = mainModel::limpiar_cadena($_POST['estacionServicio']);
        $comprobanteURL = mainModel::limpiar_cadena($_POST['comprobanteURL']);

        $data = [
            "idCombustible" => $idCombustible,
            "name" => $name,
            "idChoferes" => $idChoferes,
            "idVehiculos" => $idVehiculos,
            "kilometraje" => $kilometraje,
            "cantidad" => $cantidad,
            "monto" => $monto,
            "tipoCombustible" => $tipoCombustible,
            "estacionServicio" => $estacionServicio,
            "comprobanteURL" => $comprobanteURL

        ];

        if (CombustibleModel::updateCombustibleModel($data)) {
            $msg = ["alert" => "save"];
        } else {
            $msg = ["alert" => "error"];
        }
        return mainModel::mensajeRespuesta($msg);
    }

    public function paintForm($saveUpdate) {
        $titulo = ($saveUpdate == "save") ? "Registro de Combustible" : "Editor de name";
        $subtitulo = ($saveUpdate == "save") ? '<p class="panel-subtitle">Por favor , llene  todos los campos y de click en guardar</p>' : '';

        $html = '<section class="panel">
                <header class="panel-heading">
                  <h2 class="panel-title">' . $titulo . '</h2>' . $subtitulo . '</header>
                <div class="panel-body ">
                <div class="caja' . $saveUpdate . '"> </div>
                  <div class="row mb-xs">
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      <input type="hidden"  name="' . $saveUpdate . '" >
                      <input type="hidden" class="idCombustible"  name="idCombustible" >
                           <label class="control-label">Nombre<span class="required">*</span> </label>
                          <input type="text" name="name" class="form-control name"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>

                   
   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Choferes<span class="required">*</span> </label>
                        <select class="form-control mb-md idChoferes" name="idChoferes"  required="">
    ' . mainModel::getList("SELECT * FROM tchoferes", "idChoferes") . '</select>
                      </div>
                    </div>           

   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Vehículos<span class="required">*</span> </label>
                        <select class="form-control mb-md idVehiculos" name="idVehiculos" required="">
                        ' . mainModel::getList("SELECT * FROM tvehiculos", "idVehiculos") . ' 
    </select>
                      </div>
                    </div>

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Kilometraje<span class="required">*</span> </label>
                        <input type="text" name="kilometraje" class="form-control kilometraje"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>  

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Cantidad<span class="required">*</span> </label>
                        <input type="text" name="cantidad" class="form-control cantidad"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>  

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Monto<span class="required">*</span> </label>
                        <input type="text" name="monto" class="form-control monto"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>  

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Tipo de Combustible<span class="required">*</span> </label>
                        <input type="text" name="tipoCombustible" class="form-control tipoCombustible"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>  

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Estación de Servicio<span class="required">*</span> </label>
                        <input type="text" name="estacionServicio" class="form-control estacionServicio"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>  

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">URL del Comprobante<span class="required">*</span> </label>
                        <input type="text" name="comprobanteURL" class="form-control comprobanteURL"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>  

</div> <div class="loadGuardadof"> </div>  ';
                $html .= '<footer class="panel-footer panf' . $saveUpdate . '">
                   <div class="row">
                      <div class="col-sm-9 col-sm-offset-3">
             <button type="submit"  class="mb-xs mt-xs mr-xs modal-basic btn btn-primary"  >Guardar</button> ';
        if ($saveUpdate == "save") {
            $html .= ' <a  class="btn btn-default" onclick="resetForm()">Limpiar</a>';
        } else {
            $html .= ' <button class="btn btn-default modalform-dismiss">Cerrar</button>';
        }
        $html .= ' </div>
                    </div>
                </footer>
              </section>';
        return $html;
    }

    public function saveCombustibleController() {
        $name = mainModel::limpiar_cadena($_POST['name']);
        $idChoferes = mainModel::limpiar_cadena($_POST['idChoferes']);
        $idVehiculos = mainModel::limpiar_cadena($_POST['idVehiculos']);
        $kilometraje = mainModel::limpiar_cadena($_POST['kilometraje']);
        $cantidad = mainModel::limpiar_cadena($_POST['cantidad']);
        $monto = mainModel::limpiar_cadena($_POST['monto']);
        $tipoCombustible = mainModel::limpiar_cadena($_POST['tipoCombustible']);
        $estacionServicio = mainModel::limpiar_cadena($_POST['estacionServicio']);
        $comprobanteURL = mainModel::limpiar_cadena($_POST['comprobanteURL']);

        $consultaName = mainModel::execute_query("SELECT * FROM tcombustible WHERE name = '$name'");

        if ($consultaName->rowCount() >= 1) {
            $msg = ["alert" => "duplicidad", "campo" => $name];
        } else {
            $data = [
                "name" => $name,
                "idChoferes" => $idChoferes,
                "idVehiculos" => $idVehiculos,
                "kilometraje" => $kilometraje,
                "cantidad" => $cantidad,
                "monto" => $monto,
                "tipoCombustible" => $tipoCombustible,
                "estacionServicio" => $estacionServicio,
                "comprobanteURL" => $comprobanteURL
            ];

            if (CombustibleModel::saveCombustibleModel($data)) {
                $msg = ["alert" => "save"];
            } else {
                $msg = ["alert" => "error"];
            }
        }
        return mainModel::mensajeRespuesta($msg);




    }
}
