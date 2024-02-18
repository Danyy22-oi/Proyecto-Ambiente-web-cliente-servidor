<!DOCTYPE html>
<html lang="en">
<?php
include_once "../include/templates/headerAdmin.php";

?>
;<main>
    <div>
        <h2>Usuarios
        </h2>
        <div>
            <a href=""><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Aaron</td>
                    <td>Vasquez</td>
                    <td>correo@correo.com</td>
                    <td>Admin</td>
                    <td>12345678</td>
                    <td>
                        <a href="cruds/actualizarUsuario.php"><i class="fa-solid fa-pen"></i><a>
                        <a href="cruds/eliminarUsuario.php"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>correojohn@doe.com</td>
                    <td>Usuario</td>
                    <td>87654321</td>
                    <td>
                        <a href="cruds/actualizarUsuario.php"><i class="fa-solid fa-pen"></i><a>
                        <a href="cruds/eliminarUsuario.php"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<?php
include_once "../include/templates/footer.php";

?>

</html>