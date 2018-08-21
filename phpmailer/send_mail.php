<?php
if(isset($_POST['email'])) {
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "contato@autocartec.com.br";
    $email_subject = "Nova mensagem no site";
 
    function died($error) {
        // your error code can go here
        echo "Desculpe mas existem erros no formulário. ";
        echo $error."<br /><br />";
        echo "Por favor, volte e arrume.<br /><br />";
        die();
    }
 
    // validation expected data exists
    /*
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('Desculpe mas você deve preencher o formulário corretamente.');       
    }
    */
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    /*
    if(!preg_match($email_exp,$email_from)) {
      $error_message .= 'O email que você informou não é válido.<br />';
    }*/
 
  $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(strlen($comments) < 2) {
    $error_message .= 'Por favor escreva uma mensagem corretamente.<br />';
  }
/* 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 */
  $email_message = "Detalhes da mensagem.\n\n";
 
  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }
 
  $email_message .= "Nome: ".clean_string($name)."\n";
  $email_message .= "Email: ".clean_string($email_from)."\n";
  $email_message .= "Mensagem: ".clean_string($message)."\n";
 
  // create email headers
  $headers = 'From: '.$email_from."\r\n".
  'Reply-To: '.$email_from."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  @mail($email_to, $email_subject, $email_message, $headers);
?>
<center>
  Mensagem enviada com sucesso!
  <br /><br />
  <br /><br />
  <a href="/">Voltar</a>
</center>  
<?php
}
?>