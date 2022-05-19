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

      $mail = new PHPMailer();

      switch ($destinatario) {
        
        case 'Cliente':

          //ENVIOS
          $mail->setFrom($post['email'], $post['name']);
          $mail->addAddress(EMAIL_CLIENT, NAME_CLIENT);     //Add a recipient
          $mail->addReplyTo($post['email'], $post['name']);
          break;
        
        case 'Usuario':

          //ENVIOS
          $mail->setFrom(EMAIL_CLIENT, NAME_CLIENT);
          $mail->addAddress($post['email'], $post['name']);     //Add a recipient
          $mail->addReplyTo(EMAIL_CLIENT, NAME_CLIENT);
          break;

      }

      switch ($template) {

        case 'Contacto Cliente':
          $template_email = $this->selectEmailTemplate($post, 'to_client');
          $subject = 'Nueva consulta desde el ' . $post['origin'];
          break;
        
        case 'Contacto Usuario':
          $template_email = $this->selectEmailTemplate($post, 'to_user');
          $subject = 'Gracias por tu contacto.';
          break;
        
      }

      if (ENVIRONMENT === 'local') {
        $mail->isSendmail();
      } else {
        $mail->isSMTP();
      }

      //SERVER SETTINGS
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
      $mail->Host       = SMTP;                     
      $mail->SMTPAuth   = true;                                   
      $mail->Username   = EMAIL_CLIENT;                    
      $mail->Password   = PASSWORD;                              
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->CharSet = EMAIL_CHARSET;
      $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set 

      //CONTENIDO
      $mail->isHTML(true);                                  
      $mail->Subject = $subject;
      $mail->Body    = $template_email;

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