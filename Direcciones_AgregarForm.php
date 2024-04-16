<?php

include 'include/templates/header.php';
include_once "include/functions/autenticado.php";
$auth = estaAutenticado();
if (!$auth) {
    header('Location: /');
}
?>

<main class="container mt-4">
    <h1>Direcciones</h1>
    <h4>Aqui puedes actualizar tus direcciones de envío</h4>
    <div id="mensajes-error"></div>
    <div>
        <form id="input_form">
            <div>
                <input type="text" name="id" id="id" value="<?php echo $_SESSION['id'] ?>" hidden>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion 1</label>
                    <input type="text" class="form-control" name="direccion" id="direccion">
                </div>
                <div class="mb-3">
                    <label for="direccion2" class="form-label">Direccion 2(Opcional)</label>
                    <input type="text" class="form-control" name="direccion2" id="direccion2">
                </div>
            </div>

            <button id="submit" type="submit" class="btn btn-primary color-boton mb-2">Agregar las direcciones de envio</button>
        </form>
    </div>
</main>

<script>
    $(document).ready(function() {

        const url = 'obtenerDirecciones.php';


        function obtenerInformacionDireccion() {
            fetch(url)
                .then(function(resultado) {
                    return resultado.json();
                })
                .then(function(datos) {
                    if (datos.length == 0) {
                       
                    } else {

                        if (datos.length == 1) {
                            mostrarDireccion(datos);
                            var userId = $('#id').val();
                            window.location.href = 'Direcciones.php?id=' + userId;
                        }
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }

        function mostrarDireccion(arregloDireccion) {
            arregloDireccion.forEach(function(direccion) {

                //id
                const id = document.querySelector("#id");
                id.value = direccion.id_direccion
                //direccion1
                const direccion1 = document.querySelector("#direccion");
                direccion1.value = direccion.direccion_1;
                //direccion2
                const direccion2 = document.querySelector('#direccion2');
                direccion2.value = direccion.direccio_2;
            });
        }
        obtenerInformacionDireccion();



        $('#input_form').on('submit', function(e) {
            e.preventDefault();
            var errores = [];
            let direccion1 = $('#direccion').val();
            let direccion2 = $('#direccion2').val();

            if (direccion1 === '') {
                errores.push('El campo dirección es obligatorio');
            }

            if (errores.length === 0) {
                var formData = $(this).serialize();
                $.ajax({
                    url: 'agregarDireccion.php',
                    type: 'POST',
                    data: formData,
                    beforeSend: function(respuesta) {
                        console.log(formData);
                        console.log('Enviando datos...');
                    },
                    success: function(respuesta) {
                        console.log(formData + "holaa");
                        console.log('Datos recibidos');
                        var mensajesError = $('#mensajes-error');
                        mensajesError.html('');
                        var successMessage = $('<p>').text('Datos agregados correctamente').addClass('text-success');
                        mensajesError.append(successMessage);


                        var userId = $('#id').val();
                        window.location.href = 'Direcciones.php?id=' + userId;
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