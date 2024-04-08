<div class="container">
    <?php if (count($productos) > 0) : ?>
    <h1 class="my-4">Nuestros Productos de Mujer</h1>


    <div class="row">
        <?php foreach ($productos as $producto) : ?>
        <div class="col-lg-4 mb-4">
            <div class="card card-hover  h-100">
                <a href="#"><img class="card-img-top" src="../img/productos/<?php echo $producto['Imagen']?>"
                        alt="<?= $producto['Nombre'] ?>"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a><?= $producto['Nombre'] ?></a>
                    </h4>
                    <p class="card-text"><?= $producto['Descripcion'] ?></p>
                    <hr>
                    <p class="card-text">Precio: ₡<?= $producto['Precio'] ?></p>
                    <hr>
                    <div class="text-center">
                        <a href="detalleProducto.php?id=<?= $producto['Id_Producto'] ?>" class="btn btn-primary"
                            style="background-color: #048088;">Ver Detalles</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else : ?>
    <p>No hay productos a mostrar</p>
    <?php endif; ?>

</div>