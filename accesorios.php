<?php
require_once "DAL/productosCrud.php";


$elSQL = "SELECT * FROM productos WHERE Id_Categoria = '3'";
$productos = getArray($elSQL);

$elSQL2 = "SELECT * FROM subcategoria";
$subCategorias = getArray($elSQL2);
include_once "include/templates/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<main>
    <?php 
        include 'include/templates/menuSubCategoria_accesorio.php';
        include 'include/templates/rangoBusquedaAccesorio.php';
        include 'include/templates/accesoriosLista.php';
    ?>
</main>

<?php
include_once "include/templates/footer.php";
?>
</html>