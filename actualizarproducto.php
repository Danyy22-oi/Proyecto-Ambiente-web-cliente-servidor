<?php

require_once "DAL/productosCrud.php";
require_once "include/functions/autenticado.php";
$auth = estaAutenticado();
if (!$auth) {
    header('Location: /');
}

$authAdmin = estaAutenticadoAdmin();
if (!$authAdmin) {
    header('Location: /');
}

$categorias = getArray("SELECT * FROM categorias");
$subcategorias = getArray("SELECT * FROM subcategoria");
$proveedores = getArray("SELECT * FROM proveedores");
$tallas = getArray("SELECT * FROM tallas");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require_once "include/functions/recoge.php";
    $id = recogeGet("id");

    $query = "SELECT p.Id_Producto, p.Nombre, p.Descripcion, p.Precio, p.Imagen, p.Id_Categoria, p.Id_Subcategoria, p.Id_Proveedor, 
    (SELECT GROUP_CONCAT(pt.Cantidad) FROM producto_talla pt WHERE pt.Id_Producto = p.Id_Producto) AS Cantidades,
    (SELECT GROUP_CONCAT(pt.Id_Talla) FROM producto_talla pt WHERE pt.Id_Producto = p.Id_Producto) AS Tallas
    FROM productos p
    WHERE p.Id_Producto = '$id'";
    $mySession = getObject($query);

    if ($mySession != null) {
        $id = $mySession['Id_Producto'];
        $nombre = $mySession['Nombre'];
        $descripcion = $mySession['Descripcion'];
        $precio = $mySession['Precio'];
        $cantidad = $mySession['Cantidades'];
        $talla = $mySession['Tallas'];
        $cantidadArray = explode(',', $cantidad);
        $tallaArray = explode(',', $talla);
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
    $cantidad = isset($_POST['cantidad']) ? array_filter($_POST['cantidad'], 'is_numeric') : array();
    $talla = isset($_POST['talla']) ? $_POST['talla'] : '';
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

    if (empty($talla) || empty($cantidad)) {
        $errores['talla_cantidad'] = 'Por favor, seleccione al menos una talla y una cantidad para esa talla';
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
        if (EditarProducto($id, $nombre, $descripcion, $precio, $imagen, $categoria, $subcategoria, $proveedor)) {
            $tallas_con_cantidad = array_combine($talla, $cantidad);

            if ($tallas_con_cantidad !== false) {
                foreach ($tallas_con_cantidad as $talla_item => $cantidad_item) {
                    if (!EditarProductoTalla($id, $talla_item, $cantidad_item)) {
                        echo "Error al agregar las tallas al producto.";
                    }
                }
            } else {
                echo "Error al combinar los arrays de tallas y cantidades.";
            }

            header('Location: /admin/productos.php');
            echo "<div class='alert alert-success' role='alert'>Producto agregado correctamente.</div>";
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
                <label for="nombre">Nombre<span class="required">*</span></label>
                <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" maxlength="255" value="<?= $nombre ?>">
                <?php if (!empty($errores['nombre'])) : ?>
                    <div class="text-danger"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción<span class="required">*</span></label>
                <textarea class="form-control" id="Descripcion" name="descripcion" rows="2" maxlength="200"><?= $descripcion ?></textarea>
                <?php if (!empty($errores['descripcion'])) : ?>
                    <div class="text-danger"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="precio">Precio<span class="required">*</span></label>
                <input type="number" class="form-control" id="Precio" name="precio" placeholder="Precio" value="<?= $precio ?>">
                <?php if (!empty($errores['precio'])) : ?>
                    <div class="text-danger"><?php echo $errores['precio']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label>Tallas (Selección múltiple)<span class="required">*</span></label>
                <div class="row">
                    <?php $colSize = ceil(count($tallas) / 3); ?>
                    <?php foreach ($tallas as $index => $tallaItem) : ?>
                        <?php if ($index % $colSize === 0) : ?>
                            <div class="col-md-4">
                            <?php endif; ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="talla_<?php echo $tallaItem['Id_Talla']; ?>" name="talla[]" value="<?php echo $tallaItem['Id_Talla']; ?>" <?php if (in_array($tallaItem['Id_Talla'], $tallaArray)) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="talla_<?php echo $tallaItem['Id_Talla']; ?>">
                                    <?php echo $tallaItem['Descripcion']; ?>
                                </label>
                                <?php
                                $indice = array_search($tallaItem['Id_Talla'], $tallaArray);
                                if ($indice !== false && isset($cantidadArray[$indice])) {
                                    $cantidadValue = $cantidadArray[$indice];
                                } else {
                                    $cantidadValue = '';
                                }
                                ?>
                                <input type="number" class="form-control" id="cantidad_<?php echo $tallaItem['Id_Talla']; ?>" name="cantidad[<?php echo $tallaItem['Id_Talla']; ?>]" placeholder="Cantidad" value="<?php echo $cantidadValue; ?>">
                            </div>
                            <?php if (($index + 1) % $colSize === 0 || ($index + 1) === count($tallas)) : ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($errores['talla_cantidad'])) : ?>
                    <div class="text-danger"><?php echo $errores['talla_cantidad']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <br>
            <div class="form-group">
                <label for="categoria">Categoría<span class="required">*</span></label>
                <select class="form-control" id="Categoria" name="categoria">
                    <?php foreach ($categorias as $cat) : ?>
                        <option value="<?= $cat['Id_Categoria'] ?>" <?= ($cat['Id_Categoria'] == $Id_Categoria) ? 'selected' : '' ?>>
                            <?= $cat['Descripcion'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="subcategoria">Subcategoría<span class="required">*</span></label>
                <select class="form-control" id="Subcategoria" name="subcategoria">
                    <?php foreach ($subcategorias as $subcat) : ?>
                        <option value="<?= $subcat['id_SubCategoria'] ?>" <?= ($subcat['id_SubCategoria'] == $Id_Subcategoria) ? 'selected' : '' ?>>
                            <?= $subcat['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="proveedor">Proveedor<span class="required">*</span></label>
                <select class="form-control" id="Proveedor" name="proveedor">
                    <?php foreach ($proveedores as $prov) : ?>
                        <option value="<?= $prov['Id_Proveedor'] ?>" <?= ($prov['Id_Proveedor'] == $Id_Proveedor) ? 'selected' : '' ?>>
                            <?= $prov['Nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Actualizar Producto</button>
            </div>
            <br>
        </form>
    </div>
</main>
<script>
    function subirImagen(event) {

        var formData = new FormData();
        var file = document.getElementById('imagen').files[0];
        formData.append('imagen', file);

        $.ajax({
            url: 'subirImagenProducto.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    $('form').on('submit', subirImagen);
</script>

<?php
include_once 'include/templates/footer.php';
?>

</html>