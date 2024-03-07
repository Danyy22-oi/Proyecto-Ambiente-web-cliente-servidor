<!DOCTYPE html>
<html lang="en">
<?php
include_once "../include/templates/header.php";

?>
;<main>
    <div>
        <h2>Productos
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
                    <th>Categoría</th>
                    <th>Talla</th>
                    <th>Existencias</th>
                    <th>Precio</th>
                    <th>Color</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Zapato Deportivo</td>
                    <td>Zapatos</td>
                    <td>Talla</td>
                    <td>20</td>
                    <td>$59.99</td>
                    <td>Negro</td>
                    <td>
                        <a href="cruds/actualizarProducto.php"><i class="fa-solid fa-pen"></i><a>
                        <a href="cruds/eliminarProducto.php"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Collar Elegante</td>
                    <td>Accesorios</td>
                    <td>Talla</td>
                    <td>15</td>
                    <td>$29.99</td>
                    <td>Dorado</td>
                    <td>
                        <a href="cruds/actualizarProducto.php"><i class="fa-solid fa-pen"></i><a>
                        <a href="cruds/eliminarProducto.php"><i class="fa-solid fa-trash"></i></a>
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