const url = 'obtenerDirecciones.php';


function obtenerInformacionDireccion() {
    fetch(url)
        .then(function (resultado) {
            return resultado.json();
        })
        .then(function (datos) {
            mostrarDireccion(datos);
        })
        .catch(error => {
            console.log(error);
        });
}
function mostrarDireccion(arregloDireccion) {
    arregloDireccion.forEach(function (direccion) {

        //id
        const id = document.querySelector("#id");
        id.value = direccion.id_direccion
        //direccion1
        const direccion1 = document.querySelector("#direccion");
        direccion1.value = direccion.direccion_1;
        //direccion2
        const direccion2 = document.querySelector('#direccion2');
        direccion2.value = direccion.direccio_2;
    }
    );
}
obtenerInformacionDireccion() ;
