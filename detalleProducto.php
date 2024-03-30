<?php
include_once "include/templates/header.php";
require_once "DAL/productosCrud.php";

if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];
    $elSQL = "SELECT p.*, prov.Nombre AS Proveedor 
    FROM productos p 
    LEFT JOIN proveedores prov ON p.Id_Proveedor = prov.Id_Proveedor 
    WHERE p.Id_Producto = $idProducto";

    $producto = getObject($elSQL);
}
?>

<main>

    <div class="container">
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
                        <a href="<?php echo isset($_SESSION['usuario']) ? 'carrito.php?id=' . $producto['Id_Producto'] : 'login.php'; ?>" class="btn btn-primary" style="background-color: #048088;">Añadir al carrito</a>
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
