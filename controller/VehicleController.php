<?php 
if ($peticionAjax) {
    require_once "../model/VehicleModel.php";
} else {
    require_once "./model/VehicleModel.php";
}

class VehicleController extends VehicleModel {


    public function getMOdelosVehiculos($idMarcaVehiculo){

        $html="";

        //AQUI OBTIENES DATOS DE LA BASE DE DATOS
         $consulta = mainModel::execute_query("SELECT * FROM tvehiclemodel WHERE idVehicleBrand  = $idMarcaVehiculo");
        $req = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($req as $index=>$row) {

             $html.= "<option value='".$row["idVehicleModel"]."'> ".$row["name"]." </option>";

        }

        return $html;


    }

    public function listVehicleController($request, $status) {
    $cnn = mainModel::conect();
    $btn = ($status == 1) ? "danger" : "success";
    $icon = ($status == 1) ? "trash fa-lg" : "check fa-lg";

    $col = array(0 => 'idVehicle', 1 => 'nserie', 2 => 'color', 3 => 'estado', 4 => 'modelYear', 5 => 'nombre_departamento', 6 => 'nombre_marca', 7 => 'nombre_modelo', 8 => 'dateRegister');
    $index = ($request['order'][0]['column'] != 5) ? $request['order'][0]['column'] : 0;

    $sql = "SELECT SQL_CALC_FOUND_ROWS tvehicle.*, 
                   tdepartamento.name AS nombre_departamento,
                   tvehiclebrand.name AS nombre_marca,
                   tvehiclemodel.name AS nombre_modelo
            FROM tvehicle 
            INNER JOIN tdepartamento ON tvehicle.idDepa = tdepartamento.idDepa 
            INNER JOIN tvehiclebrand ON tvehicle.idVehicleBrand = tvehiclebrand.idVehicleBrand
            INNER JOIN tvehiclemodel ON tvehicle.idVehicleModel = tvehiclemodel.idVehicleModel
            WHERE tvehicle.status = :status";

    $query = $cnn->prepare($sql);
    $query->bindParam(':status', $status);
    $query->execute();

    if (!empty($request['search']['value'])) {
        $sql .= " AND nserie LIKE :search";
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
        $encryp = mainModel::encryption($row['idVehicle']);
        $row['idVehicle'] = $encryp;
        $subdata[] = $contador;
        $subdata[] = $row['nserie'];
        $subdata[] = $row['color'];
        $subdata[] = $row['estado'];
        $subdata[] = $row['modelYear'];
        $subdata[] = $row['nombre_departamento']; // Nombre del departamento
        $subdata[] = $row['nombre_marca'];        // Nombre de la marca
        $subdata[] = $row['nombre_modelo'];       // Nombre del modelo
        $subdata[] = $row['dateRegister'];

        $operacionescrud = "<a onclick='rellEditV2(" . $encryp . ",vehicleAjax," . SERVERURL . ",idVehicle)' class='btn btn-primary btn-xs  mr-xs' data-toggle='modal' data-target='#modalesForm'><i class='fa-regular fa-pen-to-square'></i></a>";
        $operacionescrud .= "<button type='submit' onclick='modalOnActivaDeleteDataTable(vehicleAjax," . $encryp . "," . $status . "," . SERVERURL . ")' class='btn btn-" . $btn . " btn-xs '> <i class='fa fa-" . $icon . "'></i></button>";

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
            if (mainModel::activateDeleteSimple("tvehicle", $idElemento, $status, "idVehicle")) {
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
        $idVehicle = mainModel::limpiar_cadena($_GET['idVehicle']);
        $idVehicle = mainModel::decryption($idVehicle);

        $consulta = mainModel::execute_query("SELECT * FROM tvehicle WHERE idVehicle = $idVehicle");
        $req = $consulta->fetch(PDO::FETCH_ASSOC);
        $cuerpo = ' <script> 
$(".nserie").val("' . $req['nserie'] . '");
$(".plate").val("' . $req['plate'] . '");
$(".nVin").val("' . $req['nVin'] . '");
$(".nEngine").val("' . $req['nEngine'] . '");
$(".color").val("' . $req['color'] . '");
$(".currentPlate").val("' . $req['currentPlate'] . '");
$(".previousPlate").val("' . $req['previousPlate'] . '");
$(".annotations").val("' . $req['annotations'] . '");
$(".owner").val("' . $req['owner'] . '");
$(".estado").val("' . $req['estado'] . '");
$(".modelYear").val("' . $req['modelYear'] . '");
$(".idDepa").val("' . $req['idDepa'] . '");
$(".idVehicleBrand").val("' . $req['idVehicleBrand'] . '");
$(".idVehicleModel").val("' . $req['idVehicleModel'] . '");
</script>';
        return $cuerpo;
    }

    public function updateVehicleController() {
        $idVehicle = mainModel::limpiar_cadena($_POST['idVehicle']);
        $idVehicle = mainModel::decryption($idVehicle);
        $nserie = mainModel::limpiar_cadena($_POST['nserie']);
        $plate = mainModel::limpiar_cadena($_POST['plate']);
        $nVin = mainModel::decryption($nVin);
        $nEngine = mainModel::limpiar_cadena($_POST['nEngine']);
        $color = mainModel::limpiar_cadena($_POST['color']);
        $currentPlate = mainModel::limpiar_cadena($_POST['currentPlate']);
        $previousPlate = mainModel::limpiar_cadena($_POST['previousPlate']);
        $annotations = mainModel::limpiar_cadena($_POST['annotations']);
        $owner = mainModel::decryption($owner);
        $estado = mainModel::limpiar_cadena($_POST['estado']);
        $modelYear = mainModel::limpiar_cadena($_POST['modelYear']);
        $idDepa = mainModel::limpiar_cadena($_POST['idDepa']);
        $idVehicleBrand = mainModel::limpiar_cadena($_POST['idVehicleBrand']);
        $idVehicleModel = mainModel::limpiar_cadena($_POST['idVehicleModel']);

        $data = [
            "idVehicle" => $idVehicle,
            "nserie" => $nserie,
            "plate" => $plate,
            "nVin" => $nVin,
            "nEngine" => $nEngine,
            "color" => $color,
            "currentPlate" => $currentPlate,
            "previousPlate" => $previousPlate,
            "annotations" => $annotations,
            "owner" => $owner,
            "estado" => $estado,
            "modelYear" => $modelYear,
            "idDepa" => $idDepa,
            "idVehicleBrand" => $idVehicleBrand,
            "idVehicleModel" => $idVehicleModel
        ];

        if (VehicleModel::updateVehicleModel($data)) {
            $msg = ["alert" => "save"];
        } else {
            $msg = ["alert" => "error"];
        }
        return mainModel::mensajeRespuesta($msg);
    }

    public function paintForm($saveUpdate) {
        $titulo = ($saveUpdate == "save") ? "Registro de Vehìculos" : "Editor de nserie";
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
                      <input type="hidden" class="idVehicle"  name="idVehicle" >
                           <label class="control-label">N° SERIE<span class="required">*</span> </label>
                          <input type="text" name="nserie" class="form-control nserie"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                    
                           <label class="control-label">N° PLACA<span class="required">*</span> </label>
                          <input type="text" name="plate" class="form-control plate"  maxlength="15"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
              
                           <label class="control-label">N° VIN<span class="required">*</span> </label>
                          <input type="text" name="nVin" class="form-control nVin"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div> 
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      
                           <label class="control-label">N° MOTOR<span class="required">*</span> </label>
                          <input type="text" name="nEngine" class="form-control nEngine"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                   
                           <label class="control-label">COLOR<span class="required">*</span> </label>
                          <input type="text" name="color" class="form-control color"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
              
                           <label class="control-label">PLACA VIGENTE<span class="required">*</span> </label>
                          <input type="text" name="currentPlate" class="form-control currentPlate"  maxlength="15"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                
                           <label class="control-label">PLACA ANTERIOR<span class="required">*</span> </label>
                          <input type="text" name="previousPlate" class="form-control previousPlate"  maxlength="15"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                    
                           <label class="control-label">ANOTACIONES<span class="required">*</span> </label>
                          <input type="text" name="annotations" class="form-control annotations"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">PROPIETARIO<span class="required">*</span> </label>
                          <input type="text" name="owner" class="form-control owner"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                 
                           <label class="control-label">ESTADO<span class="required">*</span> </label>
                          <input type="text" name="estado" class="form-control estado"  maxlength="15"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                                            <label class="control-label">AÑO DE MODELO<span class="required">*</span> </label>
                          <input type="number" name="modelYear" class="form-control modelYear"  maxlength="10"  required title="Este campo es obligatorio" >
                      </div>
                    </div>                   
   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">SEDE<span class="required">*</span> </label>
                        <select class="form-control mb-md idDepa" name="idDepa" required="">
    ' . mainModel::getList("SELECT * FROM tdepartamento", "idDepa") . '</select>
                      </div>
                    </div>                     
     <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">MARCA<span class="required">*</span> </label>
                        <select class="form-control mb-md idVehicleBrand" name="idVehicleBrand" onchange="actualizarModelos()" required="">
                        <?php echo
                            ' . mainModel::getList("SELECT * FROM tvehiclebrand", "idVehicleBrand") . ' 
                          </select>
                      </div>
                    </div>
   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">MODELO<span class="required">*</span> </label>
                        <select class="form-control mb-md idVehicleModel" name="idVehicleModel" required="">
    </select>
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

    public function saveVehicleController() {
        $nserie = mainModel::limpiar_cadena($_POST['nserie']);
        $plate = mainModel::limpiar_cadena($_POST['plate']);
        $nVin = mainModel::limpiar_cadena($_POST['nVin']);
        $nEngine = mainModel::limpiar_cadena($_POST['nEngine']);
        $color = mainModel::limpiar_cadena($_POST['color']);
        $currentPlate = mainModel::limpiar_cadena($_POST['currentPlate']);
        $previousPlate = mainModel::limpiar_cadena($_POST['previousPlate']);
        $annotations = mainModel::limpiar_cadena($_POST['annotations']);
        $owner = mainModel::limpiar_cadena($_POST['owner']);
        $estado = mainModel::limpiar_cadena($_POST['estado']);
        $modelYear = mainModel::limpiar_cadena($_POST['modelYear']);
        $idDepa = mainModel::limpiar_cadena($_POST['idDepa']);
        $idVehicleBrand = mainModel::limpiar_cadena($_POST['idVehicleBrand']);
        $idVehicleModel = mainModel::limpiar_cadena($_POST['idVehicleModel']);

        $consultaNserie = mainModel::execute_query("SELECT * FROM tvehicle WHERE nserie = '$nserie'");

        if ($consultaNserie->rowCount() >= 1) {
            $msg = ["alert" => "duplicidad", "campo" => $nserie];
        } else {
            $data = [
                "nserie" => $nserie,
                "plate" => $plate,
                "nVin" => $nVin,
                "nEngine" => $nEngine,
                "color" => $color,
                "currentPlate" => $currentPlate,
                "previousPlate" => $previousPlate,
                "annotations" => $annotations,
                "owner" => $owner,
                "estado" => $estado,
                "modelYear" => $modelYear,
                "idDepa" => $idDepa,
                "idVehicleBrand" => $idVehicleBrand,
                "idVehicleModel" => $idVehicleModel
            ];

            if (VehicleModel::saveVehicleModel($data)) {
                $msg = ["alert" => "save"];
            } else {
                $msg = ["alert" => "error"];
            }
        }
        return mainModel::mensajeRespuesta($msg);




    }
}