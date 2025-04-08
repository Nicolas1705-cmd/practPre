<?php
//session_start();
if ($peticionAjax) {
//    require_once "../model/CorreoModel.php";
    require_once "../PHPMailer/Exception.php";
    require_once "../PHPMailer/PHPMailer.php";
    require_once "../PHPMailer/SMTP.php";
} else {
//    require_once "./model/CorreoModel.php";
    require_once "./PHPMailer/Exception.php";
    require_once "./PHPMailer/PHPMailer.php";
    require_once "./PHPMailer/SMTP.php";
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CorreoService {

    private $mailError;
    private $smtpHost = "smtp.gmail.com";
    private $smtpUsuario = "hola56545753@gmail.com";
    private $smtpClave = "ycwfohejgpdkgbve";
    private $mailRemitenteNombre = "WORLD CARRIER EXPRESS";

    public function getError() {
        return $this->mailError;
    }

    public function enviarMailPersonalizado(array $datos, $fase = 1, $pdfContent = null): array
    {
        //echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        //var_dump($datos);
        echo "".$this->smtpHost."";
        $mail = new PHPMailer(true);
        $this->mailError = ''; // Reset error message

        try {
            $mail->isSMTP();
            $mail->Host = $this->smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpUsuario;
            $mail->Password = $this->smtpClave;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = "UTF-8";
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            $mail->setFrom($this->smtpUsuario, $this->mailRemitenteNombre);
            $mail->addAddress($datos['email']);
            $mail->isHTML(true);
            $mail->Subject = $datos['addressee']; // Usar 'addressee' como asunto

            $mensajeHtml = nl2br($datos['description']); // Usar 'description' como mensaje
            $mail->Body = "<html lang='es'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>{$datos['addressee']}</title>
</head>
<body style='font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 20px; background-color: #f4f4f4;'>
    <div style='width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 30px;'>
        <div style='background-color: #e74c3c; color: #ffffff; padding: 20px; border-radius: 8px 8px 0 0; text-align: center;'>
            <h2 style='margin: 0;'>Gestión de Servicios</h2>
        </div>
        <div style='padding: 20px; text-align: left;'>
            <p style='margin-top: 0; font-size: 18px; color: #333;'>¡Hola {$datos['name']}!</p>
            <hr style='border-top: 1px solid #ddd;'>
            <p style='font-size: 16px; color: #555;'>{$mensajeHtml}</p>
            <div style='text-align: center; margin-top: 30px;'>
                <div style='background-color: #e74c3c; color: #ffffff; padding: 15px 30px; border-radius: 5px; display: inline-block; font-size: 24px; margin-bottom: 20px;'>2192</div>
                <p style='font-size: 14px; color: #777;'>La vigencia de este código es de 5 minutos.</p>
            </div>
        </div>
        <div style='display: flex; margin-top: 20px; border-top: 1px solid #ddd; padding-top: 20px;'>
            <div style='width: 40%;'>
                <img src='cid:logo_wce' alt='homepage' style='max-width: 150px;'>
            </div>
            <div style='width: 60%; text-align: left; font-size: 14px; color: #777;'>
                <strong>WORLD CARRIER EXPRESS</strong><br>
                Calle Santa Teresa Nº 115 Urb. Los sauces Ate-Lima-Lima.<br>
                <b>Telf.:</b> 471 8222 <b>Anexo.</b> 211 <br>
                <a target='_blank' href='https://www.wce.com.pe/' style='color: #3498db; text-decoration: none;'>www.wce.com.pe</a>
            </div>
        </div>
        <div style='background-color: #e74c3c; color: #ffffff; padding: 15px; border-radius: 0 0 8px 8px; text-align: center; margin-top: 30px;'>
            <p style='margin: 0; font-size: 12px;'>
                <a href='https://sistemawce.com/' style='color: #ffffff; text-decoration: none; margin: 0 10px;'>www.sistemawce.com</a>
                <a href='https://facebook.com' style='color: #ffffff; text-decoration: none; margin: 0 10px;'><img src='cid:icono_facebook' alt='Facebook' style='width: 20px; vertical-align: middle;'></a>
                <a href='https://twitter.com' style='color: #ffffff; text-decoration: none; margin: 0 10px;'><img src='cid:icono_twitter' alt='Twitter' style='width: 20px; vertical-align: middle;'></a>
                <a href='https://instagram.com' style='color: #ffffff; text-decoration: none; margin: 0 10px;'><img src='cid:icono_instagram' alt='Instagram' style='width: 20px; vertical-align: middle;'></a>
            </p>
        </div>
    </div>
</body>
</html>";


            $mail->addEmbeddedImage('assets/fondo5.jpeg', 'fondo_correo');
            $mail->addEmbeddedImage('assets/wce.png', 'logo_wce');
            $mail->addEmbeddedImage('assets/facebook.jpeg', 'icono_facebook');
            $mail->addEmbeddedImage('assets/instagram.jpeg', 'icono_twitter');
            $mail->addEmbeddedImage('assets/x.png', 'icono_instagram');


            if ($fase == 2 && $pdfContent) {
                $mail->addStringAttachment($pdfContent, 'Solicitud' . uniqid() . '.pdf');
            }

            $mail->AltBody = "{$datos['description']} \n\n";

            $exito = $mail->send();

            $intentos = 1;
            while ((!$exito) && ($intentos < 3)) {
                sleep(5);
                $exito = $mail->send();
                $intentos++;
            }

            if (!$exito) {
                $this->mailError = $mail->ErrorInfo;
                error_log("Error al enviar correo (PHPMailer): " . $this->mailError);
                return ['status' => false, 'error' => 'Error al enviar el correo. Por favor, inténtelo de nuevo más tarde.'];
            } else {
                return ['status' => true, 'error' => null];
            }

        } catch (Exception $e) {
            $this->mailError = $e->getMessage();
            error_log("Error al enviar correo (Exception): " . $this->mailError);
            return ['status' => false, 'error' => 'Ocurrió un error inesperado al enviar el correo. Por favor, contacte al administrador.'];
        }
    }
}

?>
