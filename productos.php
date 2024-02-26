<?php
include_once 'include/templates/header.php';
require_once "DAL/productosCrud.php";

$elSQL = "SELECT * FROM productos";
$productos = getArray($elSQL);
?>

<main>
    <div class="container">
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
                                // Traducción del valor de 'Id_Categoria' a texto
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
                    <td><img src="<?= $producto['Imagen'] ?>" alt="<?= $producto['Nombre'] ?>"></td>
                    <td><?= $producto['Talla'] ?></td>
                    <td>
                        <a href="#" class="btn btn-success mr-1"><i class="fas fa-add"></i></a>
                        <a href="#" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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