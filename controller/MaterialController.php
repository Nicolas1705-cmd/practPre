<?php
if ($peticionAjax) {
    require_once "../model/MaterialModel.php";
} else {
    require_once "./model/MaterialModel.php";
}

class MaterialController extends MaterialModel
{

    public function listMaterialController($request, $status)
    {
        $cnn = mainModel::conect();
        $btn = "";
        $icon = "";

        if ($status == 1) {
            $btn = "danger";
            $icon = "trash fa-lg";
        } else {
            $btn = "success";
            $icon = "check fa-lg";
        }

        $col = array(
            0 => 'idMaterial',
            1 => 'name',
            2 => 'stock',
            3 => 'nserie',
            4 => 'numTelf',
            5 => 'dateRegister'
        );
        $index = 0;

        if ($request['order'][0]['column'] != 6) {
            $index = $request['order'][0]['column'];
        } else {
            $index = 0;
        }

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM tmaterial WHERE status=$status";
        $query = $cnn->query($sql);
        $totalData = $cnn->query("SELECT FOUND_ROWS()");
        $totalData = (int) $totalData->fetchColumn();

        if (!empty($request['search']['value'])) {
            $sql .= " AND (name LIKE '%" . $request['search']['value'] . "%' OR nserie LIKE '%" . $request['search']['value'] . "%' OR numTelf LIKE '%" . $request['search']['value'] . "%') ";
        }

        $query = $cnn->query($sql);
        $totalData = $cnn->query("SELECT FOUND_ROWS()");
        $totalData = (int) $totalData->fetchColumn();

        if (isset($request['order'])) {
            $sql .= " ORDER BY " . $col[$index] . " " . $request['order'][0]['dir'] . " LIMIT " .
                $request['start'] . " , " . $request['length'] . " ";
        }

        $query = $cnn->query($sql);
        $totalFilter = $totalData;
        $data = array();
        $contador = 0;

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $subdata = array();
            $contador = $contador + 1;
            $encryp = mainModel::encryption($row['idMaterial']);
            $row['idMaterial'] = $encryp;

            $subdata[] = $contador;
            $subdata[] = $row['name'];
            $subdata[] = $row['stock'];
            $subdata[] = $row['nserie'];
            $subdata[] = $row['numTelf'];
            $subdata[] = $row['dateRegister'];
            $operacionescrud = "";

            $operacionescrud .= " <a onclick='rellEditProvider2(`" . $encryp . "`,`" . 'materialAjax' . "`,`" . SERVERURL . "`,`idMaterial`)' class='btn btn-primary btn-xs mr-xs' data-toggle='modal' data-target='#modalesForm' ><i class='fa-regular fa-pen-to-square'></i> </a>";
            $operacionescrud .= "<button type='submit' onclick='modalOnActivaDeleteDataTable(`" . 'materialAjax' . "`,`" . $encryp . "`," . $status . ",`" . SERVERURL . "`)' class='btn btn-" . $btn . " btn-xs '> <i class='fa fa-" . $icon . "'></i></button> ";

            $subdata[] = $operacionescrud;
            $data[] = $subdata;
        }

        $json_data = array(
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFilter),
            "data" => $data
        );
        return json_encode($json_data);
    }

    public function activaDeleteBrandController($idElemento, $status)
    {
        $idElemento = mainModel::limpiar_cadena($idElemento);
        $idElemento = mainModel::decryption($idElemento);

        if ($idElemento != false) {
            $status = mainModel::limpiar_cadena($status);

            if (mainModel::activateDeleteSimple("tmaterial", $idElemento, $status, "idMaterial")) {
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

    public function fomUpdate()
    {
        if (!isset($_GET['id'])) {
            return json_encode(["error" => "ID de material no proporcionado."]);
        }

        $idMaterial = mainModel::limpiar_cadena($_GET['id']);
        $id = mainModel::decryption($idMaterial);

        if ($id === false) {
            return json_encode(["error" => "ID de material inválido."]);
        }

        $cnn = mainModel::conect();
        $query = $cnn->prepare("SELECT * FROM tmaterial WHERE idMaterial = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();

        $materialData = $query->fetch(PDO::FETCH_ASSOC);

        if ($materialData) {
            $materialData['idMaterial'] = $idMaterial;
            return json_encode($materialData);
        } else {
            return json_encode(["error" => "Material no encontrado."]);
        }
    }

     public function paintForm($saveUpdate){
        $titulo="";
        $subtitulo="";
        if ($saveUpdate=="save") {
            $titulo="Registro de Material";
            $subtitulo='<p class="panel-subtitle">
                                Por favor , llene  todos los campos y de click en guardar
                                </p>';
        }
        if ($saveUpdate=="update") {
            $titulo="Editor de Material";
            $subtitulo='';
        }
        $html='
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">'.$titulo.'</h2>';
        $html.=$subtitulo;
        $html.='</header>
            <div class="panel-body ">
            <div class="caja'.$saveUpdate.'">

            </div>
                <div class="row mb-xs">

                    <div class="col-sm-3 mb-xs">
                        <div class="form-group">
                        <input type="hidden"  name="'.$saveUpdate.'" >
                        <input type="hidden" class="idMaterial"  name="idMaterial" >
                               <label class="control-label">Material <span class="required">*</span> </label>
                            <input type="text" name="name" class="form-control name"    required title="Este campo es obligatorio" >
                        </div>
                    </div>

                    <div class="col-sm-3 mb-xs">
                        <div class="form-group">
                        <input type="hidden"  name="'.$saveUpdate.'" >
                        <input type="hidden" class="stock"  name="stock" >
                               <label class="control-label">Stock <span class="required">*</span> </label>
                            <input type="text" name="stock" class="form-control stock"    required title="Este campo es obligatorio" >
                        </div>
                    </div>

                    <div class="col-sm-3 mb-xs">
                        <div class="form-group">
                        <input type="hidden"  name="'.$saveUpdate.'" >
                        <input type="hidden" class="nserie"  name="nserie" >
                               <label class="control-label">Número de serie <span class="required">*</span> </label>
                            <input type="text" name="nserie" class="form-control nserie"    required title="Este campo es obligatorio" >
                        </div>
                    </div>

                    <div class="col-sm-3 mb-xs">
                        <div class="form-group">
                        <input type="hidden"  name="'.$saveUpdate.'" >
                        <input type="hidden" class="numTelf"  name="numTelf" >
                               <label class="control-label">Número de Teléfono <span class="required">*</span> </label>
                            <input type="text" name="numTelf" class="form-control numTelf"    required title="Este campo es obligatorio" >
                        </div>
                    </div>


                </div> <div class="loadGuardadof"> </div> ';
        $html.='<footer class="panel-footer panf'.$saveUpdate.'">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit"  class="mb-xs mt-xs mr-xs modal-basic btn btn-primary"  >Guardar</button> ';
        if ($saveUpdate=="save") {
            $html.=' <a  class="btn btn-default" onclick="resetForm()">Limpiar</a>';
        } else { // Si es 'update'
            $html.=' <button class="btn btn-default modalform-dismiss">Cerrar</button>';
            // REMOVIDO: Botón de WhatsApp, ya no se mostrará
            // $html.=' <button type="button" class="mb-xs mt-xs mr-xs btn btn-info" id="btnEnviarWhatsappMaterial"><i class="fab fa-whatsapp"></i> Enviar WhatsApp</button>';
        }
        $html.=' </div>
                    </div>
                </footer>
            </section>';
        return $html;
    }

    // *** MODIFICADO: saveMaterialController para enviar número de teléfono ***
    public function saveMaterialController(){
        $name= mainModel::limpiar_cadena($_POST['name']);
        $stock= mainModel::limpiar_cadena($_POST['stock']);
        $nserie= mainModel::limpiar_cadena($_POST['nserie']);
        $numTelf= mainModel::limpiar_cadena($_POST['numTelf']);

        $consultaDuplicidad=mainModel::execute_query("SELECT * FROM tmaterial WHERE nserie='$nserie' OR numTelf='$numTelf'");

        if ($consultaDuplicidad->rowCount() >= 1) {
            $msg=["alert"=>"duplicidad","campo"=>"Número de serie o Teléfono (N° Serie: $nserie, N° Telf: $numTelf)"];
        } else {
            $data=[
                "name"=>$name,
                "stock"=>$stock,
                "nserie"=>$nserie,
                "numTelf"=>$numTelf
            ];

            if (MaterialModel::saveMaterialModel($data)) {
                $mensaje = "Hola, este es un mensaje de prueba para el material \"$name\" que acabas de registrar.";
                $python_script_path = __DIR__ . '/../send_whatsapp.py';
                $numero_con_codigo_pais = '+51' . $numTelf; // Agregamos el código de país**
                $command = "python " . escapeshellarg($python_script_path) . " " . escapeshellarg($numero_con_codigo_pais) . " " . escapeshellarg($mensaje);
                exec($command, $output, $return_var);
                var_dump($output);
                var_dump($return_var);
                $msg=["alert"=>"save", "whatsapp_sent"=>true];
            } else {
                $msg=["alert"=>"error"];
            }
        }
        return mainModel::mensajeRespuesta($msg);
    }
}