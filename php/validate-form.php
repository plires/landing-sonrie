<?php

  include('functions.php');
  include('../includes/config.inc.php');
  include('../clases/app.php');
  
  require_once("../clases/repositorioSQL.php");

  $db = new RepositorioSQL();

	$token = $_POST['token'];
	$action = $_POST['action'];

	$cu = curl_init();
	curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($cu, CURLOPT_POST, 1);
	curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_KEY_SECRET, 'response' => $token)));
	curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($cu);
	curl_close($cu);

	$datos = json_decode($response, true);

	if($datos['success'] == 1 && $datos['score'] >= 0.5){

		// Verificamos si hay errores en el formulario
	  if (emptyInput($_POST['name'])){
	    $errors['error_name']='Ingresa tu nombre';
	  } else {
	    $name = $_POST['name'];
	  }

	  if (!emailCheck($_POST['email'])){
	    $errors['error_email']='Ingresa el mail :(';
	  } else {
	    $email = $_POST['email'];
	  }

	  if (emptyInput($_POST['last_name'])){
	    $errors['error_last_name']='Ingresa tu apellido';
	  } else {
	    $last_name = $_POST['last_name'];
	  }

	  if (!isset($errors)) {
	  	
	  	//grabamos en la base de datos
		  $save = $db->getRepoContacts()->saveContactFormContactInBDD($_POST);

		  //Enviamos los mails al cliente y usuario
		  $app = new App;

		  $sendClient = $app->sendEmail('Cliente', 'Contacto Cliente', $_POST);
		  $sendUser = $app->sendEmail('Usuario', 'Contacto Usuario', $_POST);

		  if ($sendClient) {
		  	
		  	$msg_contacto = 'Mensaje recibido. Le contestaremos a la brevedad. Muchas gracias!';
		    header("Location: " . BASE ."index.php?msg_contacto=". urlencode($msg_contacto) . "#msg_contacto" );
	  		exit;

		  } else {

		  	$errors['mail'] = 'Error al enviar la consulta, por favor intente nuevamente';
		  	header("Location: " . BASE . "index.php?errors=" . urlencode(serialize($errors)) . "#error");
		  	exit;

		  }

	  } else {

	  	$phone = $_POST['phone'];
	  	header("Location: " . BASE . "index.php?name=$name&email=$email&phone=$phone&last_name=$last_name&errors=" . urlencode(serialize($errors)) . "#error");
	  	exit;

	  }
	  
  } else {
  	
  	// Robot
  	$errors['robot'] = 'Error. Por favor intente nuevamente';
  	header("Location: " . BASE . "index.php?errors=" . urlencode(serialize($errors)) . "#error");
  	exit;
	}





