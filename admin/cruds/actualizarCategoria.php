<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../include/templates/headerAdmin.php";

?>
<main>
    <h1>Actualizar Categoria</h1>
    <div>
        <form method="POST">
            <Label for="nombreCategoria">Nombre</Label>
            <input type="text" name="nombreCategoria">
            <Label for="descripcionCategoria">Descripcion</Label>
            <textarea  name="descripcionCategoria"></textarea>
            <label for="statusCategoria">Status</label>
            <input type="boolval"/>
            
            
            <button type="submit">Actualizar</button>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";

?>
</html>