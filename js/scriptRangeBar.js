

document.addEventListener('DOMContentLoaded', function () {
    let rango = document.getElementById('customRange2');
    var valorRango = document.getElementById('valorRango');


    valorRango.textContent = rango.value + "₡";


    rango.addEventListener('input', function () {
        valorRango.textContent = rango.value + "₡";
    });



});

function buscarPorPrecioHombre() {
    const btnBuscarPrecio = document.getElementById('buscarPorPrecio');
    const rangoPrecios = document.getElementById('customRange2');

    const precio = rangoPrecios.value;
    window.location.href = `resultado_busqueda_hombre.php?precio=${precio}`;
}

function buscarPorPrecioMujer() {
    const btnBuscarPrecio = document.getElementById('buscarPorPrecio');
    const rangoPrecios = document.getElementById('customRange2');

    const precio = rangoPrecios.value;
    window.location.href = `resultado_busqueda_mujer.php?precio=${precio}`;
}

function buscarPorPrecioAccesorio() {
    const btnBuscarPrecio = document.getElementById('buscarPorPrecio');
    const rangoPrecios = document.getElementById('customRange2');

    const precio = rangoPrecios.value;
    window.location.href = `resultado_busqueda_accesorio.php?precio=${precio}`;
}


