<!DOCTYPE html>
<html lang="en">
<?php
include_once "include/templates/header.php";
?>
<main>
    <div>
        <h1>
            Registro
        </h1>
    </div>

    <div>
        <h2>Crea una cuenta</h2>
        <p>No tienes una cuenta? Aquí puedes crearla</p>
        <form method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido">
            <label for="correo">Correo Electronico</label>
            <input type="email" name="correo">
            <label for="Telefono">Telefono</label>
            <input type="text" name="telefono">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <label for="password2">Confirmar Contraseña</label>
            <input type="password" name="password2">
            <button type="submit">
                INICIAR SESION
            </button>
        </form>
        <p>Ya tienes una Cuenta? Inicia Sesion <span><a href="">Aqui</a></span></p>
    </div>

</main>
<?php
include_once "include/templates/footer.php";
?>

</html>