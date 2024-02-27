<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../include/templates/headerAdmin.php";

?>
<main>
    <h1>Agregar Accesorio</h1>
    <div>
        <form method="POST">
            <Label for="nombreAccesorio">Nombre</Label>
            <input type="text" name="nombreAccesorio">
            <Label for="categoriaProducto">Categoria</Label>
            <input  type="text" name="categoriaProducto"/>
            <Label for="existenciasProducto">Existencias</Label>
            <input  type="number" name="existenciasAccesorio"/>
            <Label for="precioProducto">Precio</Label>
            <input  type="number" name="precioAcesorio"/>
            <Label for="tallaProducto">Talla</Label>
            <input type="text" name="tallaProducto">
            <Label for="colorProducto">Color</Label>
            <input type="text" name="colorProducto">
            <button type="submit">Agregar</button>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";

?>
</html>