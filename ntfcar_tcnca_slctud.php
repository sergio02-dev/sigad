<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer;
$mail->CharSet = "UTF-8";
$mail->ClearAddresses(); 

$mail->isSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'karenpalacio331@gmail.com';
$mail->Password = 'jxizlujienzifylt';
$mail->setFrom('karenpalacio331@gmail.com', 'KAREN PALACIO');
$mail->addReplyTo('karen_palaciomi@fet.edu.co', 'NOTIFICACIÓN SIGAD');
$mail->addAddress('karen_palaciomi@fet.edu.co', 'NOTIFICACIÓN SIGAD');

$mensaje = "<h1>Holis</h1> <br> <h3>Se envio correctamente el correo</h3>";

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

echo "Correo ".$exito;

/*
// Instantiation and passing `true` enables exception
$correos_ninios_grupo = $crudnotificaragendadirector->correos_ninios_grupo($codigo_calendario, $codigo_grupo);
//echo "llego acá";
if($correos_ninios_grupo){
    foreach ($correos_ninios_grupo as $data_correos_ninios_grupo) {
        $egr_codigo = $data_correos_ninios_grupo['egr_codigo'];
        $egr_calendario = $data_correos_ninios_grupo['egr_calendario'];
        $egr_estudiante = $data_correos_ninios_grupo['egr_estudiante'];
        $egr_grupo = $data_correos_ninios_grupo['egr_grupo'];
        $egr_estado = $data_correos_ninios_grupo['egr_estado']; 
        $per_codigo = $data_correos_ninios_grupo['per_codigo'];
        $per_nombre = $data_correos_ninios_grupo['per_nombre'];
        $per_segundonombre = $data_correos_ninios_grupo['per_segundonombre'];
        $per_primerapellido = $data_correos_ninios_grupo['per_primerapellido'];
        $per_segundoapellido = $data_correos_ninios_grupo['per_segundoapellido'];
        $per_genero = $data_correos_ninios_grupo['per_genero'];
        $dba_correo = $data_correos_ninios_grupo['dba_correo'];

        $nombre_completo = $per_nombre." ".$per_segundonombre." ".$per_primerapellido." ".$per_segundoapellido;
       
        $mail = new PHPMailer;
        $mail->CharSet = "UTF-8";
        $mail->ClearAddresses(); 

        $mail->isSMTP();
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = 'karenpalacio331@gmail.com';
        $mail->Password = 'jxizlujienzifylt';
        $mail->setFrom('karenpalacio331@gmail.com', 'NOTIFICACIÓN SIGAD');
        $mail->addReplyTo($dba_correo, 'NOTIFICACIÓN SIGAD');
        $mail->addAddress($dba_correo, 'NOTIFICACIÓN SIGAD');
        
        $mensaje = "Papito ya puedes revisar la agenda del dia ".$nombre_fecha." de ".strtoupper($nombre_completo)." <br> Recuerde ingresar al enlace https://abc.edu.co/abcStudents y dar doble click a entrar";
        
        $mensaje_enviar = $mensaje;
        
        //jxizlujienzifylt ----- mi correo
        
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'NOTIFICACIÓN SIGAD';
        $mail->Body    = $mensaje_enviar;
        $mail->AltBody = 'NOTIFICACIÓN SIGAD';
        //$mail->send();
   
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

        echo "Correo ".$exito;
            
        $dba_correo = "";
    }
    
}*/
?>