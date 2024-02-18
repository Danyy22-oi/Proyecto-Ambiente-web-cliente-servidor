<!DOCTYPE html>
<html lang="en">
<?php
include_once "../include/templates/headerAdmin.php";

?>
;<main>
    <div>
        <h2>Categorias
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
                    <th>Descripcion</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Deportivos</td>
                    <td>Zapatos deportivos</td>
                    <td>True</td>
                    <td>
                    <a href="cruds/actualizarCategoria.php"><i class="fa-solid fa-pen"></i><a>
                         <a href="cruds/eliminarCategoria.php"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Casuales</td>
                    <td>Zapatos Casuales</td>
                    <td>True</td>
                    <td>
                        <a href="cruds/actualizarCategoria.php"><i class="fa-solid fa-pen"></i><a>
                         <a href="cruds/eliminarCategoria.php"><i class="fa-solid fa-trash"></i></a>
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