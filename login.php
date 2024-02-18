<!DOCTYPE html>
<html lang="en">
<?php
include_once "include/templates/header.php";
?>
<main>
    <div>
        <h1>
            Iniciar Sesion
        </h1>
    </div>

    <div>
        <h2>Acceso</h2>
        <p>Si ya tienes una cuenta, aqui puedes iniciar sesion</p>
        <form method="POST">
            <label for="correo">Correo Electronico</label>
            <input type="email" name="correo">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <button type="submit">
                INICIAR SESION
            </button>
        </form>
        <p>No tienes una Cuenta? Registrate <span><a href="">Aqui</a></span></p>
    </div>

</main>
<?php
include_once "include/templates/footer.php";
?>

</html>