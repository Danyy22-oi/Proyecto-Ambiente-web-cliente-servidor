<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../include/templates/headerAdmin.php";
?>
<main>
    <h1>Agregar Accesorio</h1>
    <div>
        <form method="POST">
            <label for="nombreAccesorio">Nombre</label>
            <input type="text" name="nombreAccesorio">
            <label for="categoriaAccesorio">Categoría</label>
            <input  type="text" name="categoriaAccesorio"/>
            <label for="existenciasAccesorio">Existencias</label>
            <input  type="number" name="existenciasAccesorio"/>
            <label for="precioAccesorio">Precio</label>
            <input  type="number" name="precioAccesorio"/>
            <button type="submit">Agregar</button>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";
?>
</html>