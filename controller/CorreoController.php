<?php
if ($peticionAjax) {
    require_once "../model/CorreoModel.php";
} else {
    require_once "./model/CorreoModel.php";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

class CorreoController extends CorreoModel {

    public function enviarCorreoPersonalizado($datos)
{
    if (empty($datos["idEmail"])) {
        return ['status' => false, 'error' => 'La dirección de correo electrónico del destinatario no puede estar vacía.'];
    }

    $destinatario = $datos["idEmail"];
    $titulo = $datos["name"];
    $name = $datos["name"];

    // Configuración del correo SMTP
    $smtpHost = "smtp.gmail.com";
    $smtpUsuario = "hola56545753@gmail.com";
    $smtpClave = "rfskxwoxvjoclwej";

    // Crear instancia de PHPMailer
    $mail = new PHPMailer(true); // Habilitar excepciones para manejo de errores

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsuario;
        $mail->Password = $smtpClave;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->Debugoutput = 'html';
        $mail->SMTPOptions = [
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
    ],
];


        // Configuración de correo
        $mail->setFrom("hola56545753@gmail.com", "WORLD CARRIER EXPRESS");
        $mail->addAddress($destinatario); // Dirección de destino
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->Subject = $titulo;

        // Adjuntar imágenes incrustadas
 $mail->addEmbeddedImage('../assets/fondo8.jpeg', 'fondo_correo');
        $mail->addEmbeddedImage('../assets/descarga1.png', 'logo_wce');
        $mail->addEmbeddedImage('../assets/facebook2.jpeg', 'icono_facebook');
        $mail->addEmbeddedImage('../assets/x.jpeg', 'icono_twitter');
        $mail->addEmbeddedImage('../assets/instagram.jpeg', 'icono_instagram');

        $mensaje = $datos["description"];
        $mensajeHtml = nl2br($mensaje);
        $mail->Body = "<html lang='es'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>{$datos['addressee']}</title>
</head>
<body style='font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 20px; background-color: #000000;'>
    <div style='width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); padding: 20px;'>
        <div style='background-color: #ff0000; color: #ffffff; padding: 20px; border-radius: 8px 8px 0 0;'>
            <h2 style='margin: 0;'>Gestión de Servicios</h2>
        </div>
        <div style='font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 20px; background-color: #ffffff; background-image: url(\"cid:fondo_correo\"); background-repeat: repeat; background-size: auto;'>
            <p style='margin: 10px 0; font-size: 22px; font-weight: bold; color: #ff0000;'>¡Hola {$datos['name']}!</p>
            <p style='margin: 10px 0; font-size: 16px; color: #ff0000;'>{$mensajeHtml}</p>
            <div style='background-color: #ff0000; color: #ffffff; padding: 15px; border-radius: 8px; display: inline-block; font-size: 28px; margin: 20px 0; border: 2px solid #ff0000; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); color: #ffffff;'>2192</div>
            <p style='margin: 10px 0; font-size: 14px; color: #ff0000;'>{$datos['addressee']}</p>
        </div>
        <div style='display: flex; margin-top:20px;'>
            <div style='width: 30%;'>
                <img src='cid:logo_wce' alt='homepage' class='img-fluid' style='width: 80%;'>
            </div>
            <div style='width: 1px; background-color: #ccc; height: 100%; margin: 0 10px;'></div>
            <div style='width: 50%; text-align: left;'>
                Calle Santa Teresa Nº 115 Urb. Los sauces Ate-Lima-Lima. : <br>
                <b>Telf.:</b> 471 8222 <b>Anexo.</b> 211 <br>
                <a target='_blank' href='https://www.wce.com.pe/' style='color: #0056b3; text-decoration: none;'>www.wce.com.pe</a>
            </div>
        </div>
        <div style='background-color: #ff0000; color: #ffffff; padding: 10px; display: flex; justify-content: space-between; align-items: center; border-radius: 0 0 8px 8px; margin-top: 30px;'>
            <div>
                <a href='https://sistemawce.com/' style='color: #ffffff; text-decoration: none;'>www.sistemawce.com</a>
            </div>
            <div style='display: flex; justify-content: center;'>
                <a href='https://facebook.com'><img src='cid:icono_facebook' alt='Facebook' style='width: 30px; margin: 0 10px;'></a>
                <a href='https://twitter.com'><img src='cid:icono_twitter' alt='Twitter' style='width: 30px; margin: 0 10px;'></a>
                <a href='https://instagram.com'><img src='cid:icono_instagram' alt='Instagram' style='width: 30px; margin: 0 10px;'></a>
            </div>
        </div>
        <div style='margin-top: 20px; text-align: center;'>";

        // Incrustar y mostrar la imagen seleccionada desde la carpeta assets
        if (isset($datos['image']) && $datos['image'] !== '') {
            $rutaImagen = '../assets/' . $datos['image']; // Ruta ajustada
            if (file_exists($rutaImagen)) {
                $cidImagen = 'imagen_adjunta_' . uniqid(); // Generar un CID único
                $mail->addEmbeddedImage($rutaImagen, $cidImagen);
                $mail->Body .= "<img src='cid:" . $cidImagen . "' alt='Imagen Adjunta' style='max-width: 100%; height: auto;'>";
            } else {
                $mail->Body .= "<p style='color: red;'>Error: La imagen '" . $datos['image'] . "' no se encontró en la ruta '../assets/'.</p>";
                return ['status' => false, 'error' => "Error: Imagen no encontrada en assets/."];
            }
        }

        $mail->Body .= "</div>
    </div>
</body>
</html>";

        $mail->AltBody = "{$mensaje} \n\n";

        // Enviar el correo
        $exito = $mail->send();

        // Intentar reenvío en caso de error
        $intentos = 1;
        while ((!$exito) && ($intentos < 5)) {
            sleep(5);
            $exito = $mail->send();
            $intentos++;
        }

        // Estado de envío
        if (!$exito) {
            return ['status' => false, 'error' => $mail->ErrorInfo]; // Error al enviar, retornar array
        } else {
            return ['status' => true, 'error' => null]; // Enviado correctamente, retornar array
        }

    } catch (Exception $e) {
        // Si ocurre algún error al enviar el correo
        return ['status' => false, 'error' => "Error al enviar correo: {$mail->ErrorInfo}"];
    }
}

public function getEMail($idEmail) {
    $html = "";

    // AQUI OBTIENES DATOS DE LA BASE DE DATOS
    $consulta = mainModel::execute_query("SELECT * FROM temail WHERE idEmail = :idEmail");
    $consulta->bindParam(':idEmail', $idEmail, PDO::PARAM_INT); // Vincular el parámetro
    $consulta->execute(); // Ejecutar la consulta
    $req = $consulta->fetchAll(PDO::FETCH_ASSOC);

    foreach ($req as $index => $row) {
        // Cambiar el value a $row["name"] en lugar de $row["idEmail"]
        $html .= "<option value='" . htmlspecialchars($row["name"]) . "'> " . htmlspecialchars($row["name"]) . " </option>";
    }

    return $html;
}

    public function listCorreoController($request, $status) {
        $cnn = mainModel::conect();
        $btn = ($status == 1) ? "danger" : "success";
        $icon = ($status == 1) ? "trash fa-lg" : "check fa-lg";

        $col = array(0 => 'idCorreo', 1 => 'name', 2 => 'idEmail_name', 3 => 'addressee', 4 => 'description', 5 => 'image', 6 => 'dateRegister');
        $index = ($request['order'][0]['column'] != 5) ? $request['order'][0]['column'] : 0;

      /*  $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM tcorreo WHERE status = :status";*/

$sql = "SELECT SQL_CALC_FOUND_ROWS tcorreo.*, 
                   temail.name AS idEmail_name
            FROM tcorreo 
            LEFT JOIN temail ON tcorreo.idEmail = temail.idEmail
            WHERE tcorreo.status = :status";

        $query = $cnn->prepare($sql);
        $query->bindParam(':status', $status);
        $query->execute();

        if (!empty($request['search']['value'])) {
            $sql .= " AND (name LIKE :search OR idEmail LIKE :search OR addressee LIKE :search OR description LIKE :search OR image LIKE :search)";
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
        $encryp = mainModel::encryption($row['idCorreo']);
        $row['idCorreo'] = $encryp;
        $subdata[] = $contador;
        $subdata[] = $row['name'];

        if ($row['tipoEnvio'] == 1) {
            $subdata[] = "TODOS LOS CORREOS";
        } else {
            $subdata[] = $row['idEmail_name'];
        }

           
            $subdata[] = $row['addressee'];
            $subdata[] = $row['description'];
            $subdata[] = $row['image'];
            //aaaa
            $subdata[] = $row['dateRegister'];


            $operacionescrud = "<a onclick='rellEditV2(`".$encryp."`,`".'correoAjax'."`,`".SERVERURL."`,`idCorreo`)' class='btn btn-primary btn-xs  mr-xs' data-toggle='modal' data-target='#modalesForm'><i class='fa-regular fa-pen-to-square'></i></a>";
            $operacionescrud .= "<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'correoAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-" . $btn . " btn-xs '> <i class='fa fa-" . $icon . "'></i></button>";

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
            if (mainModel::activateDeleteSimple("tcorreo", $idElemento, $status, "idCorreo")) {
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
    $idCorreo = mainModel::limpiar_cadena($_GET['idCorreo']);
    $idCorreo = mainModel::decryption($idCorreo);

    $consulta = mainModel::execute_query("SELECT * FROM tcorreo WHERE idCorreo = $idCorreo");
    $req = $consulta->fetch(PDO::FETCH_ASSOC);
    $cuerpo = ' <script>
$(".name").val("' . $req['name'] . '");
$(".tipoEnvio").val("' . $req['tipoEnvio'] . '");';

    if ($req['tipoEnvio'] == 2 && $req['idEmail'] !== null) {
        $cuerpo .= '$(".idEmail").val("' . $req['idEmail'] . '");';
    } else {
        // Si tipoEnvio es 1 o idEmail es null, no preseleccionamos nada específico
        $cuerpo .= '$(".idEmail").val(""); // O podrías seleccionar una opción por defecto si la tienes';
    }

    $cuerpo .= '$(".addressee").val("' . $req['addressee'] . '");
$(".description").val("' . $req['description'] . '");
$(".image").val("' . $req['image'] . '");
</script>';
    return $cuerpo;
}

    public function updateCorreoController() {
    $idCorreo = mainModel::limpiar_cadena($_POST['idCorreo']);
    $idCorreo = mainModel::decryption($idCorreo);
    $name = mainModel::limpiar_cadena($_POST['name']);
    $tipoEnvio = mainModel::limpiar_cadena($_POST['tipoEnvio']);
    $idEmail = null;
    if ($tipoEnvio == 2 && isset($_POST['idEmail']) && $_POST['idEmail'] !== '') {
        $idEmail = mainModel::limpiar_cadena($_POST['idEmail']);
    }

    $addressee = mainModel::limpiar_cadena($_POST['addressee']);
    $description = mainModel::limpiar_cadena($_POST['description']);
    $image = mainModel::limpiar_cadena($_POST['image']);

    $data = [
        "idCorreo" => $idCorreo,
        "name" => $name,
        "tipoEnvio" => $tipoEnvio,
        "idEmail" => $idEmail,
        "addressee" => $addressee,
        "description" => $description,
        "image" => $image
    ];

    if (CorreoModel::updateCorreoModel($data)) {
        $msg = ["alert" => "save"];
    } else {
        $msg = ["alert" => "error"];
    }
    return mainModel::mensajeRespuesta($msg);
}

    public function paintForm($saveUpdate) {
        $titulo = ($saveUpdate == "save") ? "Registro de Destinatario" : "Editor de Destinatario";
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
                      <input type="hidden" class="idCorreo"  name="idCorreo" >
                           <label class="control-label">Nombre del Destinatario<span class="required">*</span> </label>
                          <input type="text" name="name" class="form-control name"  maxlength="100"  required title="Este campo es obligatorio" >

                          </div>
                    </div>

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">tipo de envio<span class="required">*</span> </label>
                        <select class="form-control mb-md tipoEnvio" name="tipoEnvio" required="">
<option value="1" > TODOS </option> <option value="2" > Personalizado </option> </select>
                      </div>
                    </div> 

<div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">email<span class="required">*</span> </label>
                        <select class="form-control mb-md idEmail" name="idEmail">
    ' . mainModel::getList("SELECT * FROM temail", "idEmail") . '</select>
                      </div>
                    </div> 

          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Asunto del Correo<span class="required">*</span> </label>
                          <input type="text" name="addressee" class="form-control addressee"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>

          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Descripción</label>
                          <input type="text" name="description" class="form-control description"  maxlength="255" >
                      </div>
                    </div>

          <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Imagen<span class="required">*</span> </label>
                          <input type="file" name="image" class="form-control image"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>

</div>

<div class="loadGuardadof"> </div>  ';
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

public function saveCorreoController() {
    error_log("Inicio de saveCorreoController", 0);
        $name = mainModel::limpiar_cadena($_POST['name']);
    $tipoEnvio = mainModel::limpiar_cadena($_POST['tipoEnvio']);
    $idEmail = null; // Inicializar en null

    if ($tipoEnvio == 2 && isset($_POST['idEmail']) && $_POST['idEmail'] !== '') {
        $idEmail = mainModel::limpiar_cadena($_POST['idEmail']);
    }
    // Si tipoEnvio es 1, $idEmail se mantiene en null (o el valor vacío que enviaste)

    $addressee = mainModel::limpiar_cadena($_POST['addressee']);
    $description = mainModel::limpiar_cadena($_POST['description']);
    $imageName = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['image']['name'];
    }

    $data_registro = [
        "name" => $name,
        "tipoEnvio" => $tipoEnvio,
        "idEmail" => $idEmail,
        "addressee" => $addressee,
        "description" => $description,
        "image" => $imageName
    ];

     if (CorreoModel::saveCorreoModel($data_registro)) {
        if ($tipoEnvio == 1) {
            $consulta = mainModel::execute_query("SELECT email FROM tclient ");
            $req = $consulta->fetchAll(PDO::FETCH_ASSOC);

            $envios_exitosos = 0;
            $errores_envio = [];

            foreach ($req as $value) {
                $datos_correo = [
                    'idEmail' => $value["email"],
                    'addressee' => $addressee,
                    'name' => $name,
                    'description' => $description,
                    'image' => $imageName
                ];
                $envio = self::enviarCorreoPersonalizado($datos_correo);
                if ($envio['status']) {
                    $envios_exitosos++;
                } else {
                    $errores_envio[] = "Error al enviar a " . $value["email"] . ": " . $envio['error'];
                }
            }

            if (empty($errores_envio)) {
                $msg = ["alert" => "save", "texto" => "Destinatario guardado y correo enviado correctamente a todos los clientes." . ($imageName !== '' ? " Imagen adjunta: " . $imageName : "")];
            } else {
                $msg = ["alert" => "save", "texto" => "Destinatario guardado. Hubo errores al enviar a algunos clientes: " . implode(", ", $errores_envio) . ($imageName !== '' ? " (Imagen adjunta pudo haber sido enviada a algunos)" : "")];
            }
        } else {
            if ($idEmail !== null && $idEmail !== '') {
                $datos_correo = [
                    'idEmail' => $idEmail,
                    'addressee' => $addressee,
                    'name' => $name,
                    'description' => $description,
                    'image' => $imageName
                ];
                $envio = self::enviarCorreoPersonalizado($datos_correo);
                if ($envio['status']) {
                    $msg = ["alert" => "save", "texto" => "Destinatario guardado y correo enviado correctamente a " . $idEmail . "." . ($imageName !== '' ? " Imagen adjunta: " . $imageName : "")];
                } else {
                    $msg = ["alert" => "save", "texto" => "Destinatario guardado, pero hubo un error al enviar el correo a " . $idEmail . ": " . $envio['error'] . ($imageName !== '' ? " (Imagen adjunta no enviada)" : "")];
                }
            } else {
                $msg = ["alert" => "save", "texto" => "Destinatario guardado. No se especificó un correo para el envío personalizado."];
            }
        }
    } else {
        $msg = ["alert" => "error", "texto" => "Error al guardar el destinatario."];
    }
    return mainModel::mensajeRespuesta($msg);
}

        public function enviarCorreoPublicitarioController() {
        $name = mainModel::limpiar_cadena($_POST['name']);
        $idEmail = mainModel::limpiar_cadena($_POST['idEmail']);
        $addressee = mainModel::limpiar_cadena($_POST['addressee']);
        $description = mainModel::limpiar_cadena($_POST['description']);
        $image = mainModel::limpiar_cadena($_POST['image']);

        $datos_correo = [
            'idEmail' => $idEmail,
            'addressee' => $addressee,
            'name' => $name,
            'description' => $description,
            'image' => $image
        ];

        if ($resultado_envio['status']) {

            $data_registro = [
                "name" => $name,
                "idEmail" => $idEmail,
                "addressee" => $addressee,
                "description" => $description,
                "image" => $image
            ];
            CorreoModel::saveCorreoModel($data_registro);
            $msg = ["alert" => "save", "texto" => "Correo enviado correctamente."];
        } else {
            $msg = ["alert" => "error", "texto" => "Error al enviar el correo: " . $resultado_envio['error']];
        }
        return mainModel::mensajeRespuesta($msg);
    }

    private function getError() {
        return $this->correoService->getError();
    }
}

?>