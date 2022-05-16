const header = document.getElementsByTagName("header")[0]
// const firstSection = document.getElementById("first_section")


// HABILITAR ESTA FUNCION PARA QUE EL HEADER APAREZCA Y DESAPAREZCA EN FUNCION
// DEL SCROLL HACIA ARRIBA O ABAJO
var start = true;
window.addEventListener('scroll', function(){

	if ( window.scrollY > 100) {
		showlHeader()
	} else {
		hidelHeader()
	}

});

function showlHeader() {
  header.classList.add('background')
  document.getElementById("first_section").style.marginTop = "160px";
}

function hidelHeader() {
	header.classList.remove('background')
  document.getElementById("first_section").style.marginTop = "0";
}

/*

toggle.addEventListener('click', function(){
	menuToggle()
});

// Validacion del Formulario
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

// Verificar recaptcha de los formularios
function verifyRecaptcha(formName = null, key = null, action = null) {

	var errorsInFieldsFront = false

  // Validacion del Formulario
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var form = document.getElementById(formName);

  // Loop over them and prevent submission
  if (form.checkValidity() === false) {
    event.preventDefault();
    event.stopPropagation();
    errorsInFieldsFront = true
  }

	form.classList.add('was-validated');

  if (!errorsInFieldsFront) {
  	grecaptcha.ready(function() {
      grecaptcha.execute(key , {
        action: action
        }).then(function(token) {
        $('#' + formName).prepend('<input type="hidden" name="token" value="' + token + '" >');
        $('#' + formName).prepend('<input type="hidden" name="action" value="' + action + '" >');
        $('#' + formName).submit();
      });
    });
  }
  
}

if ( window.scrollY > 200) {
  showlHeader()
} else {
  hidelHeader()
}
*/

AOS.init();
