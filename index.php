<?php
	
	require ('includes/config.inc.php');
  include_once('includes/soporte.php');

  if (isset($_GET['name'])) {
    $name = $_GET['name'];
  } else {
    $name = '';
  }

  if (isset($_GET['last_name'])) {
    $last_name = $_GET['last_name'];
  } else {
    $last_name = '';
  }

  if (isset($_GET['email'])) {
    $email = $_GET['email'];
  } else {
    $email = '';
  }

  if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];
  } else {
    $phone = '';
  }

  if (isset($_GET['errors'])) {

    $errors = unserialize(urldecode($_GET['errors']));
  } else {
    $errors = '';
  }

  if (isset($_GET['msg_contacto'])) {
    $msg_contacto = urldecode($_GET['msg_contacto']);
  } 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Tag Manager Head -->
	<?php include_once("./includes/tag_manager_head.php"); ?>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="En la Fundación Sonríe la Vida buscamos contribuir para que los tratamientos centrados en la Longevidad y el Bienestar Emocional sean accesibles para todos, sin importar su edad, origen, raza, estatus social/económico o género.">
	<title>Buscamos que vivas Intensamente - sonrie la vida</title>

	<!-- Favicons -->
	<?php include('includes/favicon.php'); ?>

	<link rel="stylesheet" type="text/css" href="./../node_modules/normalize.css/normalize.css">
	<link rel="stylesheet" type="text/css" href="./../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="./../node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./../node_modules/aos/dist/aos.css"/>
	<link rel="stylesheet" href="./css/app.css">
</head>
<body>
	<!-- Tag Manager Body -->
	<?php include_once("./includes/tag_manager_body.php"); ?>

	<!-- Contenido HOME -->
	<section class="transition home">

		<!-- Header -->
		<header class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<a class="branding" href="./">
						<img class="img-fluid logo transition" src="./img/logo-header.png" alt="logo sonrie la vida">
					</a>
				</div>
			</div>
		</header>
		<!-- Header end -->

		<!-- Pos Header -->
		<section id="first_section" class="container-fluid pos_header">
	  	<div class="row h-100">

		  	<div class="col-sm-7 gradient">
		  		<div class="row">
		  			<div class="col-md-10 offset-md-1">
			        <h1>Buscamos que <br>vivas Intensamente</h1>
			        <p>
			        	Nuestra fundación trabaja para acercar la tecnología de Inteligencia Artificial al ser humano, y así poder aportar a su bienestar, su longevidad y su felicidad. 
			        </p>
		  			</div>
		  		</div>
		  	</div>

		  	<div class="col-sm-5 p-0">
	        <img class="img-fluid img_fundacion" src="./img/colibri.jpg" alt="colibri">
		  	</div>

	  	</div>
		</section>
		<!-- Pos Header end -->

		<!-- Formulario -->
		<section id="section_formulario" class="container formulario">
	  	<div class="row">

		  	<div class="col-md-10 offset-md-1">

		  		<div class="content_form">

		  			<!-- Mensaje Exito -->
			      <?php if (isset($msg_contacto)): ?>
			        <div id="msg_contacto" class="alert alert-success alert-dismissible fade show" role="alert">
			          <strong>¡Datos recibidos!</strong>
			          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			          <ul style="padding: 0;">
			              <li>- <?php echo $msg_contacto; ?></li>
			          </ul>
			        </div>
			      <?php endif ?>
			      <!-- Mensaje Exito end -->

			      <!-- Errores Formulario -->
			      <?php if ($errors): ?>

			        <div id="error" class="alert alert-danger alert-dismissible fade show" role="alert">
			          <strong>¡Por favor verificá los datos!</strong>
			          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			          <ul style="padding: 0;">
			            <?php foreach ($errors as $error) { ?>
			              <li>- <?php echo $error; ?></li>
			            <?php } ?>
			          </ul>
			        </div>

			      <?php endif ?>
			      <!-- Errores Formulario end -->

			      <h2>
			      	¿Está interesado en aprender más sobre los avances en el área de la longevidad y como lo hemos logrado en nuestra Fundación?
			      </h2>

			      <p data-aos="fade-up">
			      	Contactanos para saber cómo podemos ayudarte a que vivas intensamente, tengas el balance emocional esperado y así poder también aportar a las causas de la comunidad
			      </p>

			      <form data-aos="fade-up" id="form-contacto" action="./php/validate-form.php" method="post" class="needs-validation" novalidate>

			        <input name="origin" type="hidden" value="Formulario de Contacto">

			        <div class="row">

			        	<div class="col-md-6">
			        		
					        <!-- Nombre -->
					        <div class="mb-3">
					          <label for="name" class="form-label">Nombre *</label>
					          <input required type="text" class="form-control" value="<?= $name ?>" name="name">
					          <div class="invalid-feedback">
					            Ingresá tu nombre
					          </div>
					        </div>

					        <!-- Apellido -->
					        <div class="mb-3">
					          <label for="last_name" class="form-label">Apellido *</label>
					          <input required type="text" class="form-control" value="<?= $last_name ?>" name="last_name">
					          <div class="invalid-feedback">
					            Ingresá tu apellido
					          </div>
					        </div>

			        	</div>

			        	<div class="col-md-6">
			        		
					        <!-- Email -->
					        <div class="mb-3">
					          <label for="email" class="form-label">Email *</label>
					          <input required type="email" class="form-control" value="<?= $email ?>" name="email">
					          <div class="invalid-feedback">
					            Ingresá tu email
					          </div>
					        </div>

					        <!-- Telefono -->
					        <div class="mb-3">
					          <label for="phone" class="form-label">Teléfono</label>
					          <input type="tel" class="form-control" value="<?= $phone ?>" name="phone">
					        </div>

			        	</div>

			        </div>

			        <div class="text-center">
			        	<button type="button" id="send" class="btn btn-primary">Solicitar información</button>
			        </div>

			      </form>
		  			
		  		</div>
	        
		  	</div>

	  	</div>
		</section>
		<!-- Formulario end -->

		<!-- Foco de Trabajo -->
		<section class="container-fluid back_light_color foco_trabajo">
			<div class="container p-0">
		  	<div class="row">

			  	<div data-aos="fade-up" class="col-md-12">
		        <h2>Nuestro Foco de Trabajo</h2>
		        <p>
		        	En la Fundación Sonríe la Vida buscamos contribuir para que los tratamientos centrados en la Longevidad y el Bienestar Emocional sean accesibles para todos, sin importar su edad, origen, raza, estatus social/económico o género. Esto lo logramos realizando desarrollos tecnológicos sobre el envejecimiento y el equilibrio emocional en nuestro propio centro de Investigación de vanguardia y lo llevamos a la gente mediante la colaboración y cooperación con otras organizaciones.
		        </p>
		        <div class="text-center">
		        	<a href="#section_formulario" class="btn btn-primary">+ Info</a>
		        </div>
			  	</div>

		  	</div>
	  	</div>
		</section>
		<!-- Foco de Trabajo end -->

		<!-- Grados -->
		<section class="container-fluid grados">
			<div class="container p-0">
				<div class="row">

					<div class="col-md-12">
						<h2 data-aos="fade-up">Los tres grados de bienestar según nuestra institución</h2>
					</div>

				  <div data-aos="fade-up" class="col-sm-6 col-lg-4 grado_individual">
				  	<div class="content_grado">
				  		<img class="img-fluid" src="./img/grado1.png" alt="grado 1">
				  		<div class="content_data">
					  		<h3>GRADO 1<br>impacto individual</h3>
					  		<p>
					  			1&ordm; Acceso a la educación, la salud, la alimentación, la vivienda o los bienes de consumo, entre otras cosas. 
					  		</p>
				  		</div>
				  	</div>
				  </div>

				  <div data-aos="fade-up" class="col-sm-6 col-lg-4 grado_individual">
				  	<div class="content_grado">
				  		<img class="img-fluid" src="./img/grado2.png" alt="grado 2">
				  		<div class="content_data">
					  		<h3>GRADO 2<br>impacto grupal</h3>
					  		<p>
					  			2&ordm; El incremento en la calidad de vida en aspectos físicos, mentales, emocionales y sociales.
					  		</p>
				  		</div>
				  	</div>
				  </div>

				  <div data-aos="fade-up" class="col-sm-6 col-lg-4 grado_individual">
				  	<div class="content_grado">
				  		<img class="img-fluid" src="./img/grado3.png" alt="grado 3">
				  		<div class="content_data">
					  		<h3>GRADO 3<br>impacto cultural</h3>
					  		<p>
					  			3&ordm; Intensamente, es la integración completa de los estados de bienestar físico, mental y espiritual. 
					  		</p>
				  		</div>
				  	</div>
				  </div>

				</div>
			</div>
		</section>
		<!-- Grados end -->

		<!-- Imagen Amigos -->
		<section data-aos="fade-up" class="container-fluid imagen_amigos">
			<div class="container p-0">
				<div class="row">
					<div class="col-md-12">
						<h2 data-aos="fade-up">EN BUSCA DE LAS CAUSAS,<br> NO SOLO LOS EFECTOS</h2>
					</div>
				</div>
			</div>
		</section>
		<!-- Imagen Amigos end --> 

		<!-- Valores -->
		<section data-aos="fade-up" class="container-fluid back_light_color valores">
			<div class="container p-0">
		  	<div class="row">

			  	<div class="col-md-12">
			  		<div class="content_valor">
				  		<div data-aos="fade-up" class="content_title">
				  			<img class="img-fluid" src="./img/mision.png" alt="icono mision">
				  			<h2>Misión</h2>
				  		</div>
			        <p data-aos="fade-up">
								Nos inspiramos en el desarrollo vital de personas que se encuentren en situaciones de vulnerabilidad física y/o emocional. Proporcionando herramientas que mejoren su desarrollo personal, entorno y 
								bienestar general.
			        </p>
			  		</div>
			  	</div>

			  	<div class="col-md-12">
			  		<div class="content_valor">
				  		<div data-aos="fade-up" class="content_title">
				  			<img class="img-fluid" src="./img/vision.png" alt="icono vision">
				  			<h2>Visión</h2>
				  		</div>
			        <p data-aos="fade-up">
								Creemos que al romperse muchos paradigmas y en lo vertiginoso de un futuro lleno de interrogantes, el ser humano oprimido en un sin sentido, necesita creer y crear una nueva realidad, partiendo de su propio bienestar. Creemos en nuestras competencias y que somos capaces de acompañar a muchas personas en ese retorno al orden natural. Cooperando y asisten do al desarrollo de otras organizaciones sin fines de lucro. Consolidando y atrayendo diversos fondos y donaciones como así realizando acciones para tal fin que logren finalmente realizar lo proyectado por la Fundación. Consolidando y atrayendo diversos fondos y donaciones como así realizando acciones para tal fin que logren finalmente realizar lo proyectado por la Fundación.
			        </p>
			  		</div>
			  	</div>

			  	<div class="col-md-12">
			  		<div class="content_valor">
				  		<div data-aos="fade-up" class="content_title">
				  			<img class="img-fluid" src="./img/objetivos.png" alt="icono objetivos">
				  			<h2>Objetivos & Creencias</h2>
				  		</div>
			        <p data-aos="fade-up">
								• Aspiramos a proporcionar a la comunidad, tecnologías capaces de mejorar los obstáculos que 
								impiden la plenitud de las personas.  
								• Apuntamos a campañas de capacitación y difusión capaces de lograr concientizar problemas como lo son, la depresión, ansiedad, bullying,  
								• Aspiramos a que nuestro CID proporcione los avances propicios para alargar y mejorar la vida. 
								• Promovemos la educación y la incorporación de programas para enseñar y capacitar a las personas. 
								• Impulsamos la expansión del Arte y los Deportes como catalizadores de emociones.  
								• Valoramos la cooperación y la disposición tanto de empresas públicas, privadas y/o Instituciones 
								Universitarias. 
								• Trabajar en conjunto con diversas ONG que puedan cooperar con el bienestar en todos sus grados 
								mediante acciones por realizar en conjunto
			        </p>
			  		</div>
			  	</div>

		  	</div>
			</div>
		</section>
		<!-- Valores end -->

		<!-- Rinascere -->
		<section data-aos="fade-up" class="container-fluid rinascere">

			<div class="row">
				<div class="image">
					<div class="container">
						<div class="row">
					  	<div data-aos="fade-up" class="col-md-12 p-0">
				        <h2>RINASCERE</h2>
				        <h3>LA INVESTIGACIÓN AL SERVICIO DEL SER HUMANO</h3>
					  	</div>
						</div>
					</div>
		  	</div>				
			</div>

			<div class="red">
				<div class="container">

			  	<div data-aos="fade-up" class="row">
				  	<div data-aos="fade-up" class="col-md-12 p-0">
			        <h2>Rinascere</h2>
			        <p>
			        	Es un método de intervención de procesos que incluyen, la biología, la física aplicada, la genética, el estudio de los 
								procesos cerebrales, y el balance emocional. 
								Para ello no solo nos basamos en áreas como la genética, exigentica sino también aportamos tecnología de 
								Inteligencia Artificial y Bioinformática aplicada para desarrollar protocolos de estudios y valoración 
								diagnóstica/estadística. 
								El objetivo del método es “entender” las causas que subyacen a partir de la aparición de síntomas o signos de 
								desequilibrio que llevan en muchos casos a un gran número de enfermedades, apuntamos precisamente a entender como los procesos de envejecimiento actúan en todas estas áreas y así podemos intervenir a tiempo brindando 
								al paciente información, la cual, es fundamental para concientizar y organizar estrategias basadas en prevención e
								intervención temprana.
			        </p>
				  	</div>
			  	</div>

			  	<div data-aos="fade-up" class="row cta">
				  	<div class="col-md-12">
			        <a href="#section_formulario" class="btn btn-primary">Solicitar información</a>
				  	</div>
			  	</div>

				</div>
			</div>

		</section>
		<!-- Rinascere end -->

		<!-- Testimonios -->
		<section data-aos="fade-up" class="testimonios">

			<div class="container">
		  	<div class="row title">
			  	<div class="col-md-12">
		        <h2 data-aos="fade-up">Testimonios</h2>
			  	</div>
		  	</div>				
			</div>
		  	
			<div class="container-fluid back_light_color p-0">

				<div class="container">
					
			  	<div class="row people">

				  	<div data-aos="fade-up" id="testimonio-1" class="col-sm-6">
				  		<div class="row">

				  			<div class="col-md-6">
						  		<div class="content_info gradient_50">
										<p>No hay enseñanza sin investigación, ni investigación sin enseñanza</p>
										<p>Agustin<br><span>30 años</span></p>
						  		</div>			  				
				  			</div>

				  			<div class="col-md-6">
						  		<div id="testimonio-1" class="image">
										<img class="img-fluid" src="./img/testimonios-1.jpg" alt="testimonios">
						  		</div>			  				
				  			</div>

				  		</div>
				  	</div>

				  	<div data-aos="fade-up" id="testimonio-2" class="col-sm-6">
				  		<div class="row">
				  			
				  			<div class="col-md-6">
						  		<div class="content_info gradient_50">
										<p>
											El Programa RINACERE salvo mi vida, ahora estoy feliz y desde ahora seré un miembro activo de esta institución.
										</p>
										<p>José<br><span>45 años</span></p>
						  		</div>			  				
				  			</div>

				  			<div class="col-md-6">
						  		<div id="testimonio-2" class="image">
										<img class="img-fluid" src="./img/testimonios-2.jpg" alt="testimonios">
						  		</div>			  				
				  			</div>

				  		</div>
				  	</div>

			  	</div>

				</div>

			</div>

		</section>
		<!-- Testimonios end -->

	</section>
	<!-- Contenido HOME end -->

	<!-- Footer -->
	<footer class="container-fluid">
	  <div class="row">

	    <div class="col-md-10 offset-md-1">
	      
	      <img class="img-fluid logo_footer" src="./img/iso-footer.png" alt="logo sonrie la vida footer">

	      <div class="rrss">
	        <a class="transition" rel="noopener" target="_blank" href="<?=RRSS_INSTAGRAM?>">
	          <i class="transition fa-brands fa-instagram-square"></i>
	        </a>
	        <a class="transition" rel="noopener" target="_blank" href="<?=RRSS_LINKEDIN?>">
	          <i class="transition fa-brands fa-linkedin"></i>
	        </a>
	        <a class="transition" rel="noopener" target="_blank" href="<?=RRSS_FACEBOOK?>">
	          <i class="transition fa-brands fa-facebook-square"></i>
	        </a>
	        <a class="transition" rel="noopener" target="_blank" href="<?=RRSS_YOUTUBE?>">
	          <i class="transition fa-brands fa-youtube"></i>
	        </a>
	      </div>

	      <div class="data">
	        <a class="transition" rel="noopener" target="_blank" href="mailto:info@fundacionsonrielavida.org">
	          <i class="transition fa-regular fa-envelope"></i>
	          info@fundacionsonrielavida.org
	        </a><br>
	        <a class="transition" rel="noopener" target="_blank" href="#">
	          <i class="transition fa-solid fa-location-dot"></i>
	          Buenos Aires - Argentina
	        </a>
	      </div>

	    </div>
	  
	  </div>
	</footer>
	<!-- Footer end -->

	<script type="text/javascript" src="./../node_modules/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="./../node_modules/jquery-easing/dist/jquery.easing.1.3.umd.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?render=<?= RECAPTCHA_KEY_SITE ?>"></script>
	<script type="text/javascript" src="./../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./../node_modules/aos/dist/aos.js"></script>
	<script type="text/javascript" src="./js/app.js"></script>

</body>

</html>