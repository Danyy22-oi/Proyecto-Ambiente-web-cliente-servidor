<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../include/templates/headerAdmin.php";

?>
<main>
    <h1>Actualizar Usuario</h1>
    <div>
        <form method="POST">
            <Label for="nombreUsuario">Nombre</Label>
            <input type="text" name="nombreUsuario">
            <Label for="apellido">Apellido</Label>
            <input  type="text" name="apellido"/>
            <Label for="correo">Correo</Label>
            <input  type="text" name="correo"/>
            <Label for="rol">Rol</Label>
            <input  type="text" name="rol"/>
            <Label for="telefono">Telefono</Label>
            <input type="text" name="telefono">
            <button type="submit">Actualizar</button>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";

?>
</html>