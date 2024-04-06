<?php 
session_start();
include_once "include/templates/header.php";
?>

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    $total = 0;
                    foreach ($_SESSION['carrito'] as $producto) {
                        $total += $producto['precio'];
                    }
                ?>
                <h2>Productos en el carrito</h2>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Talla</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                        foreach ($_SESSION['carrito'] as $key => $producto) {
                        ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td>₡<?php echo $producto['precio']; ?></td>
                            <td><img src="<?php echo $producto['imagen']; ?>" style="width: 100px; height: 100px;"></td>
                            <td><?php echo $producto['talla']; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="eliminar_producto" value="<?php echo $key; ?>">
                                    <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div style="text-align: right;">
                    <strong>Total: ₡<?php echo number_format($total, 2); ?></strong>
                </div>
                <br>
                <div class="text-center">
                    <form method="post" style="display: inline-block; margin-right: 10px;">
                        <input type="hidden" name="limpiar_carrito" value="1">
                        <button type="submit" name="submit" class="btn btn-danger">Limpiar carrito</button>
                    </form>
                    <form method="post" style="display: inline-block;">
                        <button style="background-color: #048088;" type="submit" name="agregar_carrito"
                            class="btn btn-primary">Finalizar Compra</button>
                    </form>
                </div>
                <br>
                <br>
                <?php
                } else {
                    echo "<br>";
                    echo "<p class='text-center'>No hay productos en el carrito.<h3></p>";
                }
                ?>
            </div>
        </div>
    </div>
</main>


<?php 
include_once "include/templates/footer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $indiceEliminar = $_POST['eliminar_producto'];
    unset($_SESSION['carrito'][$indiceEliminar]);
    echo '<script>window.location.href = window.location.href;</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['limpiar_carrito'])) {
  unset($_SESSION['carrito']);
  echo '<script>window.location.href = window.location.href;</script>';
  exit;
}

?>