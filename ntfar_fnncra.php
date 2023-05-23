<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$list_personas_autorizacion = $registroautorizacionresponsableaccion->list_autorizacion_financiera($codigo_accion);
$tipo = "Financiera";

if($list_personas_autorizacion){
    foreach ($list_personas_autorizacion as $dta_info) {
        $codigo_persona = $dta_info['vin_persona'];
        $per_correo = $dta_info['per_correo'];
        $per_nombre = $dta_info['per_nombre'];
        $per_primerapellido = $dta_info['per_primerapellido'];

        $nombre_usuario = $per_nombre." ".$per_primerapellido;

        if($per_correo){
            $mail = new PHPMailer;
            $mail->CharSet = "UTF-8";
            $mail->ClearAddresses(); 
            
            $mail->isSMTP();
            $mail->Host = 'ssl://smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = 'karenpalacio331@gmail.com';
            $mail->Password = 'jxizlujienzifylt';
            $mail->setFrom('karenpalacio331@gmail.com', 'NOTIFICACIONES SIGAD');
            $mail->addReplyTo($per_correo, $nombre_usuario);
            $mail->addAddress($per_correo, $nombre_usuario);
            
            $mensaje = "Tiene una nueva solicitud pendiente de aprobación ".$tipo." ".$numero_solicitud;
            
            $mensaje_enviar = $mensaje;
            
            //jxizlujienzifylt ----- mi correo
            
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'NOTIFICACIÓN SIGAD';
            $mail->Body    = $mensaje_enviar;
            $mail->AltBody = 'NOTIFICACIÓN SIGAD';
            
            $exito = $mail->Send();
            $intentos=1;
            
            while((!$exito)&&($intentos<5)&&($mail->ErrorInfo!="SMTP Error: Data not accepted")){
                sleep(5);
                $exito = $mail->Send();
                $intentos=$intentos+1;
            }
            
            if ($mail->ErrorInfo=="SMTP Error: Data not accepted") {
                $exito=true;
            }
        }
        $per_correo = '';
    }
}

?>