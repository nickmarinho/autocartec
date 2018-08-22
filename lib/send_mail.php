<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['email'])) {
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.autocartec.com.br';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'contato@autocartec.com.br';                 // SMTP username
        $mail->Password = 'Ricard02018';                           // SMTP password
        $mail->SMTPSecure = false;                            // Enable TLS encryption, `ssl` also accepted
        $mail->SMTPAutoTLS = false;
        $mail->Port = 587;                                    // TCP port to connect to
        
        //Recipients
        $mail->setFrom($_POST['email'], 'Mailer');
        $mail->addAddress('contato@autocartec.com.br', 'Contato Autocartec');     // Add a recipient
        $mail->addReplyTo($_POST['email'], $_POST['name']);
        
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Nova mensagem recebida pelo site';
        $mail->Body    = $_POST['message'];
        $mail->AltBody = $_POST['message'];
        
        $mail->send();
        echo 'Mensagem enviada com sucesso!';
    } catch (Exception $e) {
        echo 'Não foi possível enviar a mensagem!: ', $mail->ErrorInfo;
    }
}
?>