<!DOCTYPE html>
<html lang="en">
<?php 
 include_once 'include/templates/header.php';
 ?>
 <main>
    <?php 
    include "include/templates/filtrosBusqueda.php";
 
    ?>
<!-- detalles_producto.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <style>
        /* Tus estilos aquí */
    </style>
</head>
<body>

<?php
// Obtener el parámetro 'producto' pasado en la URL
if (isset($_GET['producto'])) {
    $producto_id = $_GET['producto'];

    // Aquí puedes realizar consultas a tu base de datos u obtener los detalles del producto
    // Usando el ID del producto pasado
    // Por ahora, mostraremos detalles ficticios
    $detalles_producto = obtener_detalles_producto($producto_id);

    // Mostrar los detalles del producto
    echo "<h1>Detalles del Producto</h1>";
    echo "<h2>Nombre: " . $detalles_producto['nombre'] . "</h2>";
    echo "<p>Precio: $" . $detalles_producto['precio'] . "</p>";
    echo "<p>Color: " . $detalles_producto['color'] . "</p>";
    // Otros detalles del producto
} else {
    // Si no se proporciona un ID de producto válido, mostrar un mensaje de error o redireccionar a otra página
    echo "<p>Error: No se proporcionó un ID de producto válido.</p>";
}

// Función simulada para obtener los detalles del producto de una base de datos o un arreglo
function obtener_detalles_producto($producto_id) {
    // Simulación de datos de producto
    $productos = array(
        1 => array(
            'nombre' => 'Collar Elegante',
            'precio' => 29.99,
            'color' => 'Plateado'
            // Otros detalles del producto
        ),
        // Otros productos
    );

    // Verificar si el ID del producto existe en el arreglo de productos
    if (array_key_exists($producto_id, $productos)) {
        return $productos[$producto_id];
    } else {
        // Si no se encuentra el ID del producto, devolver un arreglo vacío
        return array();
    }
}
?>

</body>
</html>
















 </main>
 <?php 
 include_once 'include/templates/footer.php';
?>

</html>