<?php
//incluimos la clase PHPMailer
require_once( __DIR__ . '/../vendor/autoload.php' );

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

  class App 
  {

    function sendmail($setFromEmail, $setFromName, $addReplyToEmail, $addReplyToName, $addAddressEmail, $addAddressName, $subject, $template){

      //Create a new PHPMailer instance
      $mail = new PHPMailer;
      
      if (ENVIRONMENT === 'local') {

        $mail->isSendmail();

      } else {

        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = SMTP;                                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = USERNAME;                               //SMTP username
        $mail->Password   = PASSWORD;                               //SMTP password
        $mail->Port       = EMAIL_PORT;
        $mail->CharSet = EMAIL_CHARSET;

        $mail->SMTPOptions = array(
          'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
          )
        );

      }

      // ENVIOS
      $mail->From = $addAddressEmail; // Email desde donde envío el correo.
      $mail->FromName = $setFromName; // Nombre para mostrar en el envío del correo.
      $mail->AddAddress($addAddressEmail); // Esta es la dirección a donde enviamos los datos del formulario
      $mail->AddReplyTo($addReplyToEmail); // Responder a:

      // CONTENIDO
      $mail->isHTML(true);
      $mail->Subject = $subject; // Este es el asunto del email.
      $mail->Body = $template; // Texto del email en formato HTML
      
      // Copia oculta
      // if (EMAIL_BCC != '') { // si no esta vacio el campo BCC
      //   $mail->addBCC(EMAIL_BCC, $subject); // Copia del email
      // }

      //send the message, check for errors
      $send = $mail->send();

      return $send;
      
    }

    function prepareEmailFormContacto($post, $to) {

      //configuro las variables a remplazar en el template
      $vars = array(
        '{facebook}',
        '{instagram}',
        '{linkedin}',
        '{name_client}',
        '{email_client}',
        '{tel_client}',
        '{wap_client}',
        '{origin}',
        '{name_user}',
        '{email_user}',
        '{phone_user}',
        '{comments_user}',
        '{date}',
        '{base}'
      );

      $values = array( 
        RRSS_FACEBOOK,
        RRSS_INSTAGRAM,
        RRSS_LINKEDIN,
        NAME_CLIENT,
        EMAIL_CLIENT,
        TEL_CLIENT,
        WAP_CLIENT,
        $post['origin'],
        $post['name'],
        $post['email'],
        $post['phone'],
        $post['comments'],
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
   
    function registerEmailContactsInPerfit($api, $list, $post) {

      if ( !isset($post['phone']) ) {
        $phone = '';
      } else {
        $phone = $post['phone'];
      }

      try {

        $perfit = new PerfitSDK\Perfit( ['apiKey' => $api ] );
        $listId = $list;

        $response = $perfit->post('/lists/' .$listId. '/contacts', 
          [
            'firstName' => $post['name'], 
            'email' => $post['email'],
            'customFields' => 
              [
                [
                  'id' => 11, 
                  'value' => $phone
                ]
              ]
          ]
        );
        
      } catch (Exception $e) {

        $errors['perfit'] = 'No se pudo cargar tu casilla al listado de newsletter.';

        header("Location: " . BASE . "contacto.php?errors=" . urlencode(serialize($errors)) . "#error");
        
      }

    }

  }

?>