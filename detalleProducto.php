<?php
session_start();
include_once "include/templates/header.php";
require_once "DAL/productosCrud.php";

$mensaje = '';

if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];
    $elSQL = "SELECT p.*, prov.Nombre AS Proveedor 
    FROM productos p 
    LEFT JOIN proveedores prov ON p.Id_Proveedor = prov.Id_Proveedor 
    WHERE p.Id_Producto = $idProducto";

    $producto = getObject($elSQL);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_carrito'])) {
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        $nombre_zapato = $_POST['nombre'];
        $precio_zapato = $_POST['precio'];
        $imagen_zapato = $_POST['imagen'];

        $_SESSION['carrito'][] = array('nombre' => $nombre_zapato, 'precio' => $precio_zapato, 'imagen' => $imagen_zapato);
        $mensaje = 'Producto añadido al carrito.';
    } else {
        header('Location: login.php');
        exit;
    }
}

?>

<main>

    <div class="container">
        <?php if (!empty($mensaje)) : ?>
            <div class="alert alert-<?php echo isset($_SESSION['login']) && $_SESSION['login'] === true ? 'success' : 'danger'; ?> mt-3" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if (isset($producto) && !empty($producto)) : ?>
                    <div class="card">
                        <div style="width: 100%; height: 100%; margin: 0 auto;">
                            <img src="<?= $producto['Imagen'] ?>" class="card-img-top img-fluid"
                                alt="<?= $producto['Nombre'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-center"><?= $producto['Nombre'] ?></h3>
                            <hr>
                            <p class="card-text" style="font-size: 18px;">Descripcion: <?= $producto['Descripcion'] ?></p>
                            <p class="card-text" style="font-size: 18px;">Precio: ₡<?= $producto['Precio'] ?></p>
                            <p class="card-text" style="font-size: 18px;">Proveedor: <?= $producto['Proveedor'] ?></p>
                            <div class="text-center">
                                <form method="post">
                                    <input type="hidden" name="nombre" value="<?= $producto['Nombre'] ?>">
                                    <input type="hidden" name="precio" value="<?= $producto['Precio'] ?>">
                                    <input type="hidden" name="imagen" value="<?= $producto['Imagen'] ?>">
                                    <button style="background-color: #048088;" type="submit" name="agregar_carrito" class="btn btn-primary">Añadir al carrito</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        No se encontró información para el producto solicitado.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</main>

<?php
include_once "include/templates/footer.php";
?>