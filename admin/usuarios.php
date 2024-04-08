<!DOCTYPE html>
<html lang="en">
<?php

include_once "../include/functions/recoge.php";
include_once "../include/functions/autenticado.php";

verificarAutenticacion();


$ingreso = recogeGET("ingreso");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "../include/fusnctions/recoge.php";
    $id =  recogePost("id");
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {
        include_once "../DAL/usuariosCrud.php";
        if (eliminarUsuario($id)) {
            header("Location: /admin/usuarios.php?ingreso=2");
        }
    }
}

include_once "../include/templates/header.php";
?>
<main>
    <div class="container">
        <br>
        <h2>Usuarios
        </h2>
        <p><?= $ingreso == 1 ? "Se actualizó el usuario correctamente" : ""; ?></p>
        <p><?= $ingreso == 2 ? "Se eliminó el usuario correctamente" : ""; ?></p>
        <?php
        require_once "../DAL/usuariosCrud.php";
        $elSQL = "SELECT id_usuario, nombre, apellido ,correo, telefono, id_rol from usuario";
        $myArray = getArray($elSQL);
     
        ?>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($myArray)) {
                    foreach ($myArray as $usuario) {
                        
                        if ($_SESSION['nombre'] != $usuario['nombre']) {
                            echo "<tr>";
                            echo "<td>" . $usuario['nombre'] . "</td>";
                            echo "<td>" . $usuario['apellido'] . "</td>";
                            echo "<td>" . $usuario['correo'] . "</td>";
                            echo "<td>" . ($usuario['id_rol'] == 1 ? "Administrador" : "Usuario") . "</td>";
                            echo "<td>" . $usuario['telefono'] . "</td>";
                            echo "<td>";
                            echo '<div class="iconos-accion">';
                            echo '<a class="btn btn-primary custom-margin" href="cruds/actualizarUsuario.php?id=' . $usuario['id_usuario'] . '"><i class="fas fa-edit"></i></a>';
                            echo '<form method="POST">';
                            echo '<input type="hidden" name="id" value="' . $usuario['id_usuario'] . '">';
                            echo '<button class="btn btn-danger" type="submit" onclick="return confirm(\'¿Está seguro de que desea eliminar este usuario?\');"><i class="fas fa-trash-alt"></i></button>';
                            echo '</form>';
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay registros de usuarios</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</main>
<?php
include_once "../include/templates/footer.php";
?>
</html>