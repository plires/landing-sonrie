$(document).ready(function() {

  $('#send').click(function() {

    var btn = document.getElementById('wait');
    
    var errorsInFieldsFront = false

    // Validacion del Formulario
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var form = document.getElementById('form-contacto');
    
    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      errorsInFieldsFront = true
    }

    form.classList.add('was-validated');

    if (!errorsInFieldsFront) {
      grecaptcha.ready(function() {
        grecaptcha.execute('6LfQXUUfAAAAALOBXiVT7UxaxlPn4q6D4leY5KnF', {
          action: 'validarFormulario'
          }).then(function(token) {
          $('#form-contacto').prepend('<input type="hidden" name="token" value="' + token + '" >');
          $('#form-contacto').prepend('<input type="hidden" name="action" value="validarFormulario" >');
          btn.classList.add('active');
          $('#form-contacto').submit();
        });
      });
    } 

  });

});