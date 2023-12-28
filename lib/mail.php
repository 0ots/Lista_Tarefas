​<?php

use PHPMailer\PHPMailer\PHPMailer;

function enviar_email($destinatario, $assunto, $mensagem) {

require 'vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'contatootaviomaciel@gmail.com';
    $mail->Password = 'yfac mwdt stiy ihet';

    $mail->SMTPSecure = 'tls';
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('contatootaviomaciel@gmail.com​', "Otávio Arantes Maciel");
    $mail->addAddress($destinatario);
    $mail->Subject = $assunto;

    $mail->Body = $mensagem;

    if($mail->send()){
    
    return true;
    }
    else{

    return false;
    }
}
?>