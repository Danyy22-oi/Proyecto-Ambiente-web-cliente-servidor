<?php

include 'include/templates/header.php';

?>

<main class="container mt-4">
    <h1>Direcciones</h1>
    <h4>Aqui puedes actualizar tus direcciones de envío</h4>
    <div id="mensajes-error"></div>
    <div>
        <form id="input_form">
            <div>
                <input type="text" name="id" id="id" hidden>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion 1</label>
                    <input type="text" class="form-control" name="direccion" id="direccion">
                </div>
                <div class="mb-3">
                    <label for="direccion2" class="form-label">Direccion 2(Opcional)</label>
                    <input type="text" class="form-control" name="direccion2" id="direccion2">
                </div>
            </div>
            <button id="submit" type="submit" class="btn btn-primary color-boton mb-2">Actualizar las direcciones de envio</button>
        </form>
    </div>
</main>

<script src="js/detallesDireccion.js"> </script>
<script>
    $(document).ready(function() {

        $('#input_form').on('submit', function(e) {
            e.preventDefault();

            var errores = []

            let direccion1 = $('#direccion').val();
            let direccion2 = $('#direccion2').val();

            if (direccion1 === '') {
                errores.push('El campo direccion es obligatorio')
            }

            if (errores.length === 0) {
                var formData = $(this).serialize();
               
                $.ajax({
                    url: 'actualizarDireccion.php',
                    type: 'POST',
                    data: formData,
                    beforeSend: function(respuesta) {
                        console.log('Enviando datos...');
                    },
                    success: function(respuesta) {
                        console.log(formData + "holaa");
                        console.log('Datos recibidos');
                        var mensajesError = $('#mensajes-error');
                        mensajesError.html('');
                        var successMessage = $('<p>').text('Datos actualizados correctamente').addClass('text-success');
                        mensajesError.append(successMessage);
                    }, 
                    error:function(){
                        console.log('Error al enviar los datos');
                    }
                });
            }else{
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