<?php

require_once "DAL/productosCrud.php";

$categorias = getArray("SELECT * FROM categorias");
$subcategorias = getArray("SELECT * FROM subcategoria");
$proveedores = getArray("SELECT * FROM proveedores");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once "include/functions/recoge.php";
    $id = recogeGet("id");

    $query = "SELECT Id_Producto, Nombre, Descripcion, Precio, Cantidad, Talla, Imagen, Id_Categoria, Id_Subcategoria, Id_Proveedor FROM productos WHERE Id_Producto = '$id'";
    $mySession = getObject($query);

    if ($mySession != null) {
        $id = $mySession['Id_Producto'];
        $nombre = $mySession['Nombre'];
        $descripcion = $mySession['Descripcion'];
        $precio = $mySession['Precio'];
        $cantidad = $mySession['Cantidad'];
        $talla = $mySession['Talla'];
        $imagen = $mySession['Imagen'];
        $Id_Categoria = $mySession['Id_Categoria'];
        $Id_Subcategoria = $mySession['Id_Subcategoria'];
        $Id_Proveedor = $mySession['Id_Proveedor'];
    } else {

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "include/functions/recoge.php";
    $id = recogePost("Id_Producto");
    $nombre = recogePost("nombre");
    $descripcion = recogePost("descripcion");
    $precio = recogePost("precio");
    $cantidad = recogePost("cantidad");
    $talla = recogePost("talla");
    $imagen = recogePost("imagen");
    $categoria = recogePost("categoria");
    $subcategoria = recogePost("subcategoria");
    $proveedor = recogePost("proveedor");

    $errores = array();

    if (empty($nombre)) {
        $errores['nombre'] = 'Por favor, ingrese el nombre del producto';
    }
    if (empty($descripcion)) {
        $errores['descripcion'] = 'Por favor, ingrese la descripción del producto';
    }
    if (empty($precio)) {
        $errores['precio'] = 'Por favor, ingrese el precio del producto';
    } elseif (!is_numeric($precio) || $precio <= 0) {
        $errores['precio'] = 'El precio debe ser un número mayor que cero';
    }
    if (empty($cantidad)) {
        $errores['cantidad'] = 'Por favor, ingrese la cantidad del producto';
    } elseif (!ctype_digit($cantidad) || $cantidad <= 0) {
        $errores['cantidad'] = 'La cantidad debe ser un número entero mayor que cero';
    }    
    if (empty($talla)) {
        $errores['talla'] = 'Por favor, ingrese la talla del producto';
    } elseif (!ctype_digit($talla) || $talla <= 0) {
        $errores['talla'] = 'La talla debe ser un número entero mayor que cero';
    }
    if (empty($imagen)) {
        $errores['imagen'] = 'Por favor, ingrese el enlace de la imagen del producto';
    }
    if (empty($categoria)) {
        $errores['categoria'] = 'Por favor, seleccione la categoría del producto';
    }
    if (empty($subcategoria)) {
        $errores['subcategoria'] = 'Por favor, seleccione la subcategoría del producto';
    }
    if (empty($proveedor)) {
        $errores['proveedor'] = 'Por favor, seleccione el proveedor del producto';
    }

    if (empty($errores)) {
        if (EditarProducto($id, $nombre, $descripcion, $precio, $cantidad, $talla, $imagen, $categoria, $subcategoria, $proveedor)) {
            header("Location: productos.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al editar el producto.</div>";
        }
    }
}

include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <h2>Editar Producto</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div>
                <input type="hidden" name="Id_Producto" value="<?= $id ?>">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" maxlength="255"
                    value="<?= $nombre ?>">
                <?php if (!empty($errores['nombre'])): ?>
                <div class="text-danger"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="Descripcion" name="descripcion" rows="2"
                    maxlength="200"><?= $descripcion ?></textarea>
                <?php if (!empty($errores['descripcion'])): ?>
                <div class="text-danger"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="Precio" name="precio" placeholder="Precio"
                    value="<?= $precio ?>">
                <?php if (!empty($errores['precio'])): ?>
                <div class="text-danger"><?php echo $errores['precio']; ?></div>
                <?php endif; ?>
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
                <?php if (!empty($errores['talla'])): ?>
                <div class="text-danger"><?php echo $errores['talla']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="text" class="form-control" id="Imagen" name="imagen" placeholder="Link de la imagen"
                    maxlength="255" value="<?= $imagen ?>">
                <?php if (!empty($errores['imagen'])): ?>
                <div class="text-danger"><?php echo $errores['imagen']; ?></div>
                <?php endif; ?>
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
                <label for="subcategoria">Subcategoría</label>
                <select class="form-control" id="Subcategoria" name="subcategoria">
                    <?php foreach ($subcategorias as $subcat): ?>
                    <option value="<?= $subcat['id_SubCategoria'] ?>"
                        <?= ($subcat['id_SubCategoria'] == $Id_Subcategoria) ? 'selected' : '' ?>>
                        <?= $subcat['nombre'] ?>
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