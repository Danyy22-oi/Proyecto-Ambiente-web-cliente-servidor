<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../include/templates/header.php";

?>
<main>
    <h1>Actualizar Producto</h1>
    <div>
        <form method="POST">
            <Label for="nombreProducto">Nombre</Label>
            <input type="text" name="nombreProducto">
            <Label for="categoriaProducto">Categoria</Label>
            <input  type="text" name="categoriaProducto"/>
            <Label for="existenciasProducto">Existencias</Label>
            <input  type="number" name="existenciasProducto"/>
            <Label for="precioProducto">Precio</Label>
            <input  type="number" name="precioProducto"/>
            <Label for="tallaProducto">Talla</Label>
            <input type="text" name="tallaProducto">
            <Label for="colorProducto">Color</Label>
            <input type="text" name="colorProducto">
            <button type="submit">Actualizar</button>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";

?>
</html>