<?php 
//session_start();
if ($peticionAjax) {
    require_once "../model/EstablecimientoModel.php";
} else {
    require_once "./model/EstablecimientoModel.php";
}

class EstablecimientoController extends EstablecimientoModel {

    public function getProvincias($idDepa) {
    $html = "";

    $consulta = mainModel::execute_query("SELECT * FROM tprovincia WHERE idDepa = $idDepa");
    $req = $consulta->fetchAll(PDO::FETCH_ASSOC);
    foreach ($req as $row) {
        $html .= "<option value='" . $row["idProv"] . "'> " . $row["name"] . " </option>";
    }
    return $html;
}

    public function getDistritos($idProv) {
    $html = "";

    $consulta = mainModel::execute_query("SELECT * FROM tdistrito WHERE idProv = $idProv");
    $req = $consulta->fetchAll(PDO::FETCH_ASSOC);
    foreach ($req as $row) {
        $html .= "<option value='" . $row["idDist"] . "'> " . $row["name"] . " </option>";
    }
    return $html;
}


    public function listEstablecimientoController($request, $status) {
    $cnn = mainModel::conect();
    $btn = ($status == 1) ? "danger" : "success";
    $icon = ($status == 1) ? "trash fa-lg" : "check fa-lg";

    $col = array(0 => 'idEstablecimiento', 1 => 'name', 2 => 'address', 3 => 'nombre_departamento', 4 => 'nombre_provincia', 5 => 'nombre_distrito', 6 => 'dateRegister');
    $index = ($request['order'][0]['column'] != 5) ? $request['order'][0]['column'] : 0;

    $sql = "SELECT SQL_CALC_FOUND_ROWS testablecimiento.*, 
                   tdepartamento.name AS nombre_departamento,
                   tprovincia.name AS nombre_provincia,
                   tdistrito.name AS nombre_distrito
            FROM testablecimiento 
            INNER JOIN tdepartamento ON testablecimiento.idDepa = tdepartamento.idDepa 
            INNER JOIN tprovincia ON testablecimiento.idProv = tprovincia.idProv
            INNER JOIN tdistrito ON testablecimiento.idDist = tdistrito.idDist
            WHERE testablecimiento.status = :status";

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
        $encryp = mainModel::encryption($row['idEstablecimiento']);
        $row['idEstablecimiento'] = $encryp;
        $subdata[] = $contador;
        $subdata[] = $row['name'];
        $subdata[] = $row['address'];
        $subdata[] = $row['nombre_departamento'];
        $subdata[] = $row['nombre_provincia'];
        $subdata[] = $row['nombre_distrito'];
        $subdata[] = $row['dateRegister'];

        $operacionescrud = "<a onclick='rellEditV2(`".$encryp."`,`".'establecimientoAjax'."`,`".SERVERURL."`,`idEstablecimiento`)' class='btn btn-primary btn-xs  mr-xs' data-toggle='modal' data-target='#modalesForm'><i class='fa-regular fa-pen-to-square'></i></a>";
        $operacionescrud .= "<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'establecimientoAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-" . $btn . " btn-xs '> <i class='fa fa-" . $icon . "'></i></button>";

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
            if (mainModel::activateDeleteSimple("testablecimiento", $idElemento, $status, "idEstablecimiento")) {
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
        $idEstablecimiento = mainModel::limpiar_cadena($_GET['idEstablecimiento']);
        $idEstablecimiento = mainModel::decryption($idEstablecimiento);

        $consulta = mainModel::execute_query("SELECT * FROM testablecimiento WHERE idEstablecimiento = $idEstablecimiento");
        $req = $consulta->fetch(PDO::FETCH_ASSOC);
        $cuerpo = ' <script> 
$(".name").val("' . $req['name'] . '");
$(".address").val("' . $req['address'] . '");
$(".idDepa").val("' . $req['idDepa'] . '");
$(".idProv").val("' . $req['idProv'] . '");
$(".idDist").val("' . $req['idDist'] . '");

</script>';
        return $cuerpo;
    }

    public function updateEstablecimientoController() {
        $idEstablecimiento = mainModel::limpiar_cadena($_POST['idEstablecimiento']);
        $idEstablecimiento = mainModel::decryption($idEstablecimiento);
        $name = mainModel::limpiar_cadena($_POST['name']);
        $address = mainModel::limpiar_cadena($_POST['address']);

        $idDepa = mainModel::limpiar_cadena($_POST['idDepa']);
        $idProv = mainModel::limpiar_cadena($_POST['idProv']);
        $idDist = mainModel::limpiar_cadena($_POST['idDist']);

        $data = [
            "idEstablecimiento" => $idEstablecimiento,
            "name" => $name,
            "address" => $address,
            "idDepa" => $idDepa,
            "idProv" => $idProv,
            "idDist" => $idDist

        ];

        if (EstablecimientoModel::updateEstablecimientoModel($data)) {
            $msg = ["alert" => "save"];
        } else {
            $msg = ["alert" => "error"];
        }
        return mainModel::mensajeRespuesta($msg);
    }

    public function paintForm($saveUpdate) {
        $titulo = ($saveUpdate == "save") ? "Registro de Establecimiento" : "Editor de name";
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
                      <input type="hidden" class="idEstablecimiento"  name="idEstablecimiento" >
                           <label class="control-label">Nombre<span class="required">*</span> </label>
                          <input type="text" name="name" class="form-control name"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                    
                           <label class="control-label">Dirección<span class="required">*</span> </label>
                          <input type="text" name="address" class="form-control address"  maxlength="15"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
                   
   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Departamento<span class="required">*</span> </label>
                        <select class="form-control mb-md idDepa" name="idDepa" onchange="actualizarProvincias()" required="">
    ' . mainModel::getList("SELECT * FROM tdepartamento", "idDepa") . '</select>
                      </div>
                    </div>                     
     <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Provincia<span class="required">*</span> </label>
                        <select class="form-control mb-md idProv" name="idProv" onchange="actualizarDistritos()" required="">
                        
                            ' . mainModel::getList("SELECT * FROM tprovincia", "idProv") . ' 
                          </select>
                      </div>
                    </div>
   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Distrito<span class="required">*</span> </label>
                        <select class="form-control mb-md idDist" name="idDist" required="">
                        ' . mainModel::getList("SELECT * FROM tdistrito", "idDist") . ' 
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

    public function saveEstablecimientoController() {
        $name = mainModel::limpiar_cadena($_POST['name']);
        $address = mainModel::limpiar_cadena($_POST['address']);

        $idDepa = mainModel::limpiar_cadena($_POST['idDepa']);
        $idProv = mainModel::limpiar_cadena($_POST['idProv']);
        $idDist = mainModel::limpiar_cadena($_POST['idDist']);

        $consultaName = mainModel::execute_query("SELECT * FROM testablecimiento WHERE name = '$name'");

        if ($consultaName->rowCount() >= 1) {
            $msg = ["alert" => "duplicidad", "campo" => $name];
        } else {
            $data = [
                "name" => $name,
                "address" => $address,

                "idDepa" => $idDepa,
                "idProv" => $idProv,
                "idDist" => $idDist
            ];

            if (EstablecimientoModel::saveEstablecimientoModel($data)) {
                $msg = ["alert" => "save"];
            } else {
                $msg = ["alert" => "error"];
            }
        }
        return mainModel::mensajeRespuesta($msg);




    }
}
