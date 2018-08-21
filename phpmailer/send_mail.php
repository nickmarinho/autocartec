<?php
if(isset($_POST['email'])) {
  //Load Composer's autoloader
  
  require '..\vendor\autoload.php';

  use phpmailer\src\PHPMailer\PHPMailer;
  use phpmailer\src\PHPMailer\Exception;
  
  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
      //Server settings
      $mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'pop.autocartec.com.br';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'contato@autocartec.com.br';                 // SMTP username
      $mail->Password = 'Ricard02018';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
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