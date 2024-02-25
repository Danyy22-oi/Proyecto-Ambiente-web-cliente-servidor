<!DOCTYPE html>
<html lang="en">
<?php
include_once "../include/templates/headerAdmin.php";
include_once "../include/functions/recoge.php";
$ingreso = recogeGET("ingreso");

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    include_once "../include/functions/recoge.php";
    $id =  recogePost("id");
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if($id){
        include_once "../DAL/usuariosCrud.php";
        if(eliminarUsuario($id)){
            header("Location: /admin/usuarios.php?ingreso=2");
        }
    }
}


?>
<main>
    <div>
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
                <?php
                if (!empty($myArray)) {
                    foreach ($myArray as $usuario)
                        echo "<tr>";
                    echo "<td>" . $usuario['nombre'] . "</td>";
                    echo "<td>" . $usuario['apellido'] . "</td>";
                    echo "<td>" . $usuario['correo'] . "</td>";
                    if ($usuario['id_rol'] == 1) {
                        echo "<td>" . "Administrador" . "</td>";
                    } else {
                        echo "<td>" . "Usuario" . "</td>";
                    }
                    echo "<td>" . $usuario['telefono'] . "</td>";
                    echo "<td>";
                    echo '<a href="cruds/actualizarUsuario.php?id=' . $usuario['id_usuario'] . '"><i class="fa-solid fa-pen"></i></a>';
                    echo '<form  method="POST">';
                    echo '<input type="hidden" name="id" value="' . $usuario['id_usuario'] . '">';
                    echo '<button type="submit"><i class="fa-solid fa-trash"></i></button>';
                    echo '</form>';
                    echo "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td>No hay registros de usuarios</td></tr>";
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