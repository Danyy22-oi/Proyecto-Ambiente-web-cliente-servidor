
const url = 'obtenerDetallesCuenta.php';

function obtenerInformacionTemas() {
    fetch(url)
        .then(function (resultado) {
            return resultado.json();
        })
        .then(function (datos) {
            mostrarUsuario(datos);
        })
        .catch(error => {
            console.log(error);
        });
}

function mostrarUsuario(arregloUsuario) {
    arregloUsuario.forEach(function (usuario) {

        //id
        const id = document.querySelector("#id");
        id.value = usuario.id_usuario
        //nombre
        const nombre = document.querySelector("#nombre");
        nombre.value = usuario.nombre;
        //apellido
        const apellido = document.querySelector('#apellido');
        apellido.value = usuario.apellido;
        //correo
        const correo = document.querySelector('#correo');
        correo.value = usuario.correo;

        //telefono
        const telefono = document.querySelector('#telefono');
        telefono.value = usuario.telefono;
        //password
        const password = document.querySelector('#password');
        password.value = usuario.contrasena
    }
    );
}

obtenerInformacionTemas();

 
