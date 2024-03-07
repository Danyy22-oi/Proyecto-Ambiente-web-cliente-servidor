
<?php

include_once 'include/templates/header.php';
require_once "DAL/productosCrud.php";
$elSQL = "SELECT * FROM productos";
$productos = getArray($elSQL);
?>

<div class="container">

    <h1 class="my-4">Nuestros Productos</h1>

    <div class="row">
        <?php foreach ($productos as $producto): ?>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="<?= $producto['Imagen'] ?>" alt="<?= $producto['Nombre'] ?>"></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?= $producto['Nombre'] ?></a>
                        </h4>
                        <p class="card-text"><?= $producto['Descripcion'] ?></p>
                        <hr>
                        <p class="card-text">Precio: ₡<?= $producto['Precio'] ?></p>
                        <hr>
                        <p class="card-text">Talla: <?= $producto['Talla'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
include_once "include/templates/footer.php";
?>
