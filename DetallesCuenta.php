<?php

include 'include/templates/header.php';

?>

<main class="container mt-4">
    <h1>Detalles Cuenta</h1>
    <div id="mensajes-error"></div>
    <div>
        <form id="input_form">
            <div>
                <input type="text" name="id" id="id" hidden>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="apellido">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="text" class="form-control" name="correo" id="correo">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                </div>
            </div>
            <div>
                <h2>Actualizar Contraseña</h2>
                <p class="text-primary">Deja esta parte en blanco si no deseas cambiar la Contraseña</p>
               
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" value="">
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                </div>
            </div>
            <button id="submit" type="submit" class="btn btn-primary color-boton mb-2">Actualizar Informacion de la cuenta</button>
        </form>
    </div>
</main>



<script src="js/detallesCuenta.js"> </script>
<script>
    $(document).ready(function() {
        $("#input_form").on('submit', function(e) {
            e.preventDefault(); 


            var errores = [];

            let nombre = $('#nombre').val().trim();
          
            let apellido = $('#apellido').val().trim();
      
            let correo = $('#correo').val().trim();
          
            let telefono = $('#telefono').val().trim();

            let password = $('#password').val()

            let newPassword = $('#newPassword').val()

            let password2 = $('#password2').val()

            if (nombre === '') {
                errores.push("El campo de nombre es obligatorio");
            }
            if (apellido === '') {
                errores.push("El campo apellido es obligatorio");
            }
            if (correo === '') {
                errores.push("El campo correo es obligatorio");
            }
            if (telefono === '') {
                errores.push("El campo telefono es obligatorio");
            }
            if ((newPassword != '') || (password2 != '')) {
                if (newPassword !== password2) {
                    errores.push("La nueva contraseña y la confirmación no coinciden");
                }
            }

            if (errores.length === 0) {
                var formData = $(this).serialize(); 

                $.ajax({
                    url: 'actualizarDatos.php',
                    type: 'POST',
                    data: formData,
                    beforeSend: function() {
                        console.log('Enviando datos...');
                    },
                    success: function(respuesta) {
                        console.log('Datos recibidos:');
                        var mensajesError = $('#mensajes-error');
                        mensajesError.html('');
                        var successMessage = $('<p>').text('Datos actualizados correctamente').addClass('text-success');
                      
                        mensajesError.append(successMessage);

                    },
                    error: function() {
                        console.log('Error al enviar los datos');
                    }
                });

            } else {
                mostrarErrores(errores);
            }
        });
    });

    function mostrarErrores(errores) {
        var mensajesError = $('#mensajes-error');
        mensajesError.html('');

        if (errores.length > 0) {
            var lista = $('<ul>');
            $.each(errores, function(index, error) {
                lista.append($('<li>').text(error)).addClass(' text-danger');
            });
            mensajesError.append(lista);
        }
    }
</script>
<?php
include 'include/templates/footer.php';

?>