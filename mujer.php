<?php
require_once "DAL/productosCrud.php";

$elSQL = "SELECT * FROM productos WHERE Id_Categoria = '2'";
$productos = getArray($elSQL);

$elSQL2 = "SELECT * FROM subcategoria";
$subCategorias = getArray($elSQL2);
include_once "include/templates/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<main>
    <?php 
        include 'include/templates/menuSubCategoria_mujer.php';
        include 'include/templates/rangoBusquedaMujer.php';
        include 'include/templates/zapatosMujer.php';
    ?>
</main>

<?php
include_once "include/templates/footer.php";
?>
</html>