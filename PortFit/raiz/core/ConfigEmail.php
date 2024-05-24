<?php
// RESPONSAVEL POR ENVIAR EMAIL

require_once(dirname(__FILE__) . '/BlockFile.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($email, $name, $title, $text, $emailName = null) {
    $mail = new PHPMailer(true);
        
    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = EMAILHOST;
        $mail->SMTPAuth = true;
        $mail->Username = EMAILADM;
        $mail->Password = EMAILPASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = EMAILPORT;
        

        // caso retorne $emailName como verdadeiro - envia o nome recebido para o email
        // caso retorne $emailName como null - envia o nome da academia para o email
        if($emailName) {
            $mail->setFrom(EMAILADM, $name);
        } else {
            $mail->setFrom(EMAILADM, EMAILNAME);
        }
    
        
        // $mail->addAddress($email, $name);
        // EMAIL FIXO PARA TESTE - APAGAR DEPOIS E DEIXAR O COM EMAIL DINAMICO (VARIAVEL)
        $mail->addAddress('pedro.megadeth@hotmail.com', $name);


        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $text;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    
    
    
        // echo 'E-Mail enviado com sucesso';
    } catch (Exception $e) {
        // echo "Erro: E-Mail nõ enviado com sucesso. Error PHPMailer: {$mail->ErrorInfo}";
    }
}

