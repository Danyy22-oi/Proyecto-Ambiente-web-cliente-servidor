const url = 'obtenerDirecciones.php';


function obtenerInformacionDireccion() {
    fetch(url)
        .then(function (resultado) {
            return resultado.json();
        })
        .then(function (datos) {
            if(datos.length == 0){
                document.getElementById("no-direcciones").style.display = "block";
                document.getElementById("submit").style.display = "none";
            }else{
            mostrarDireccion(datos);
            mostrarBotonInput();
        }
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
function mostrarBotonInput(){
    direccion = document.getElementById("direccion");
    
    if (direccion.value == "") {
        document.getElementById("submit").style.display = "none";
        document.getElementById("no-direcciones").style.display = "block";
    }else{
        document.getElementById("submit").style.display = "block";
        document.getElementById("no-direcciones").style.display = "none";
    }
}
obtenerInformacionDireccion() ;
mostrarBotonInput();
