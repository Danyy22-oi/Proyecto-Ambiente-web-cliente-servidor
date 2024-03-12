<?php
include_once "include/templates/header.php";
require_once "DAL/productosCrud.php";

$elSQL = "SELECT * FROM productos WHERE Id_Categoria = '1'";
$productos = getArray($elSQL);

$elSQL2 = "SELECT * FROM subcategoria";
$subCategorias = getArray($elSQL2);

?>

<!DOCTYPE html>
<html lang="en">

<main>

    <?php
    include 'include/templates/menuSubCategoria_hombre.php';
    include 'include/templates/rangoBusquedaHombre.php';
    include 'include/templates/zapatosHombre.php';
    ?>
</main>

<?php
include_once "include/templates/footer.php";
?>

</html>