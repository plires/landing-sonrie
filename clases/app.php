<?php
//incluimos la clase PHPMailer
require_once( __DIR__ . '/../../vendor/autoload.php' );

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

  class App 
  {

    public function sendEmail($destinatario, $template, $post)
    {

      switch ($destinatario) {
        
        case 'Cliente':
          $emailDestino = EMAIL_CLIENT;
          $nameShow = $post['name'];
          $emailAddReplyTo = $post['email'];
          $emailShow = EMAIL_CLIENT;  // Mi cuenta de correo
          break;
        
        case 'Usuario':
          $emailDestino = $post['email'];
          $nameShow = NAME_CLIENT;
          $emailAddReplyTo = EMAIL_CLIENT;
          $emailShow = EMAIL_CLIENT;  // Mi cuenta de correo
          break;

      }

      switch ($template) {

        case 'Contacto Cliente':
          $template = $this->selectEmailTemplate($post, 'to_client');
          $subject = 'Nueva consulta desde el ' . $post['origin'];
          break;
        
        case 'Contacto Usuario':
          $template = $this->selectEmailTemplate($post, 'to_user');
          $subject = 'Gracias por tu contacto.';
          break;
        
      }

      $mail = new PHPMailer();

      if (ENVIRONMENT === 'local') {
        $mail->isSendmail();
      } else {
        $mail->IsSMTP();
      }

      // SERVER SETTINGS
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->Host = SMTP; 
      $mail->Username = EMAIL_CLIENT; 
      $mail->Password = PASSWORD;
      $mail->SMTPAuth = true;
      $mail->Port = EMAIL_PORT; 
      $mail->CharSet = EMAIL_CHARSET;
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      // ENVIOS
      $mail->From = $emailShow; // Email desde donde envío el correo.
      $mail->FromName = $nameShow; // Nombre para mostrar en el envío del correo.
      $mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
      $mail->AddReplyTo($emailAddReplyTo); // Responder a:

      // CONTENIDO
      $mail->isHTML(true);
      $mail->Subject = $subject; // Este es el asunto del email.
      $mail->Body = $template; // Texto del email en formato HTML

      //send the message, check for errors
      $send = $mail->send();

      return $send;

    }

    function selectEmailTemplate($post, $to) {

      //configuro las variables a remplazar en el template
      $vars = array(
        '{facebook}',
        '{instagram}',
        '{youtube}',
        '{name_client}',
        '{email_client}',
        '{origin}',
        '{name_user}',
        '{email_user}',
        '{phone_user}',
        '{last_name_user}',
        '{date}',
        '{base}'
      );

      $values = array( 
        RRSS_FACEBOOK,
        RRSS_INSTAGRAM,
        RRSS_YOUTUBE,
        NAME_CLIENT,
        EMAIL_CLIENT,
        $post['origin'],
        $post['name'],
        $post['email'],
        $post['phone'],
        $post['last_name'],
        date('d-m-Y'),
        BASE 
      );

      switch ($to) {

        case 'to_client':
          $template = file_get_contents( __DIR__ . '/../includes/emails/contacts/contacts-to-client.php');
          break;

        case 'to_user':
          $template = file_get_contents( __DIR__ . '/../includes/emails/contacts/contacts-to-user.php');
          break;
        
        default:
          $template = file_get_contents( __DIR__ . '/../includes/emails/contacts/contacts-to-client.php');
          break;

      }

      //Remplazamos las variables por las marcas en los templates
      $template_final = str_replace($vars, $values, $template);

      return $template_final;

    }
   
  }

?>