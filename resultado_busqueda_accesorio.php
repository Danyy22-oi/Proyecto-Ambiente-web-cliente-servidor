<?php

require_once "DAL/productosCrud.php";
if (isset($_GET['subcategoria_id']) || isset($_GET['precio'])) {
    $precio = $_GET['precio'];

    $subcategoria_id = $_GET['subcategoria_id'];
    $elSQL = "SELECT *FROM productos where Id_Categoria= '3' AND (Id_Subcategoria ='$subcategoria_id' OR Precio <= '$precio') ";
    $productos = getArray($elSQL);
}
include_once 'include/templates/header.php';
?>  
    <?php
    include 'include/templates/menuSubCategoria_accesorio.php';
    
    include 'include/templates/rangoBusquedaAccesorio.php';
    if (count($productos) > 0) {

        include 'include/templates/accesoriosLista.php';
    } else {
        echo '<div class="container mt-5">';
        echo '<div class="row">';
        echo '<div class="col text-center">';
        echo '<div>';
        echo '<h2>No se encontraron productos</h2>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
   
    ?>
<?php
include_once "include/templates/footer.php";
?>