<?php

require_once "DAL/productosCrud.php";

$categorias = getArray("SELECT * FROM categorias");
$proveedores = getArray("SELECT * FROM proveedores");

if($_SERVER['REQUEST_METHOD']== 'GET'){
    require_once "include/functions/recoge.php";
    $id= recogeGet("id");

    $query = "select Id_Producto, Nombre, Descripcion, Precio, Cantidad, Talla, Imagen, Id_Categoria, Id_Proveedor from productos where Id_Producto = '$id'";
    $mySession = getObject($query);

    if($mySession != null){
            $id = $mySession['Id_Producto'];
            $nombre = $mySession['Nombre'];
            $descripcion = $mySession['Descripcion'];
            $precio = $mySession['Precio'];
            $cantidad = $mySession['Cantidad'];
            $talla = $mySession['Talla'];
            $imagen = $mySession['Imagen'];
            $Id_Categoria = $mySession['Id_Categoria'];
            $Id_Proveedor = $mySession['Id_Proveedor'];
        }else{
            
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "include/functions/recoge.php";
        $id= recogePost("Id_Producto");
        $nombre = recogePost("nombre");
        $descripcion = recogePost("descripcion");
        $precio = recogePost("precio");
        $cantidad = recogePost("cantidad");
        $talla = recogePost("talla");
        $imagen = recogePost("imagen");
        $categoria = recogePost("categoria");
        $proveedor = recogePost("proveedor");

    if (EditarProducto($id, $nombre, $descripcion, $precio, $cantidad, $talla, $imagen, $categoria, $proveedor)) {
        header("Location: productos.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al agregar el producto.</div>";
    }
}
include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <h2>Nuevo Producto</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div>
                <input type="hidden" name="Id_Producto" value="<?= $id ?>">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" maxlength="255"
                    value="<?= $nombre ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="Descripcion" name="descripcion" rows="2"
                    maxlength="255"><?= $descripcion ?></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="Precio" name="precio" placeholder="Precio"
                    value="<?= $precio ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="Cantidad" name="cantidad" placeholder="Cantidad"
                    value="<?= $cantidad ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="talla">Talla</label>
                <input type="number" class="form-control" id="Talla" name="talla" placeholder="Talla"
                    value="<?= $talla ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="text" class="form-control" id="Imagen" name="imagen" placeholder="Link de la imagen"
                    maxlength="255" value="<?= $imagen ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select class="form-control" id="Categoria" name="categoria">
                    <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['Id_Categoria'] ?>"
                        <?= ($cat['Id_Categoria'] == $Id_Categoria) ? 'selected' : '' ?>>
                        <?= $cat['Descripcion'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <select class="form-control" id="Proveedor" name="proveedor">
                    <?php foreach ($proveedores as $prov): ?>
                    <option value="<?= $prov['Id_Proveedor'] ?>"
                        <?= ($prov['Id_Proveedor'] == $Id_Proveedor) ? 'selected' : '' ?>>
                        <?= $prov['Nombre'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Actualizar Producto</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>

</html>