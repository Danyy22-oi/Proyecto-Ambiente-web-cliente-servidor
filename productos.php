<?php

require_once "DAL/productosCrud.php";

$elSQL = "SELECT * FROM productos";
$productos = getArray($elSQL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'eliminar_producto') {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            if (EliminarProducto($id)) {
                header("Location: productos.php");                
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error al eliminar el producto.</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>ID de producto no recibido.</div>";
        }
    }
}
include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <div style="float: right;">
            <a href="agregarproducto.php">
                <button type="button" class="btn btn-success color-boton">Añadir Producto</button>
            </a>
        </div>
        <h2>Productos</h2>
        <?php if (!empty($productos)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th class="max">Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th class="max">Descripción</th>
                    <th>Imagen</th>
                    <th>Talla</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['Nombre'] ?></td>
                    <td>
                        <?php
                                $categoria = '';
                                switch ($producto['Id_Categoria']) {
                                    case 1:
                                        $categoria = 'Hombres';
                                        break;
                                    case 2:
                                        $categoria = 'Mujeres';
                                        break;
                                    case 3:
                                        $categoria = 'Accesorios';
                                        break;
                                }
                                echo $categoria;
                                ?>
                    </td>
                    <td><?= $producto['Precio'] ?></td>
                    <td><?= $producto['Cantidad'] ?></td>
                    <td class="max"><?= $producto['Descripcion'] ?></td>
                    <td><img class="logo" src="<?= $producto['Imagen'] ?>" alt="<?= $producto['Nombre'] ?>"></td>
                    <td><?= $producto['Talla'] ?></td>
                    <td>
                        <a href="actualizarproducto.php?id=<?= $producto['Id_Producto'] ?>"
                            class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $producto['Id_Producto'] ?>">
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Está seguro de que desea eliminar este producto?');">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <input type="hidden" name="action" value="eliminar_producto">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No hay registros de productos.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>

</html>