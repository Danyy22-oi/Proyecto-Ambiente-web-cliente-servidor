<?php

require_once "DAL/productosCrud.php";

$categorias = getArray("SELECT * FROM categorias");
$subcategorias = getArray("SELECT * FROM subcategoria");
$proveedores = getArray("SELECT * FROM proveedores");
$tallas = getArray("SELECT * FROM tallas");

$errores = array();
$nombre = $descripcion = $precio = $cantidad = $talla = $imagen = $categoria = $proveedor = $subcategoria = '';
$cantidad_tallas = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $cantidad = isset($_POST['cantidad']) ? array_filter($_POST['cantidad'], 'is_numeric') : array();
    $talla = isset($_POST['talla']) ? $_POST['talla'] : '';
    $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $subcategoria = isset($_POST['subcategoria']) ? $_POST['subcategoria'] : '';
    $proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : '';

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
        if (AgregarProducto($nombre, $descripcion, $precio, $imagen, $categoria, $subcategoria, $proveedor)) {
            $idProducto = obtenerIdProducto();
                $tallas_con_cantidad = array_combine($talla, $cantidad);

                if ($tallas_con_cantidad !== false) {
                    foreach ($tallas_con_cantidad as $talla_item => $cantidad_item) {
                        if (!AgregarProductoTalla($idProducto, $talla_item, $cantidad_item)) {
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
        <h2>Nuevo Producto</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre<span class="required">*</span></label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="255"
                    value="<?php echo htmlspecialchars($nombre); ?>">
                <?php if (!empty($errores['nombre'])): ?>
                <div class="text-danger"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción<span class="required">*</span></label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="2"
                    maxlength="255"><?php echo htmlspecialchars($descripcion); ?></textarea>
                <?php if (!empty($errores['descripcion'])): ?>
                <div class="text-danger"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="precio">Precio<span class="required">*</span></label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio"
                    value="<?php echo htmlspecialchars($precio); ?>">
                <?php if (!empty($errores['precio'])): ?>
                <div class="text-danger"><?php echo $errores['precio']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label>Tallas (Selección Múltiple)<span class="required">*</span></label>
                <div class="row">
                    <?php $colSize = ceil(count($tallas) / 3); ?>
                    <?php foreach ($tallas as $index => $tallaItem): ?>
                    <?php if ($index % $colSize === 0): ?>
                    <div class="col-md-4">
                        <?php endif; ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                id="talla_<?php echo $tallaItem['Id_Talla']; ?>" name="talla[]"
                                value="<?php echo $tallaItem['Id_Talla']; ?>">
                            <label class="form-check-label" for="talla_<?php echo $tallaItem['Id_Talla']; ?>">
                                <?php echo $tallaItem['Descripcion']; ?>
                            </label>
                            <input type="number" class="form-control"
                                id="cantidad_<?php echo $tallaItem['Id_Talla']; ?>"
                                name="cantidad[<?php echo $tallaItem['Id_Talla']; ?>]" placeholder="Cantidad">
                        </div>
                        <?php if (($index + 1) % $colSize === 0 || ($index + 1) === count($tallas)): ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($errores['talla_cantidad'])): ?>
                <div class="text-danger"><?php echo $errores['talla_cantidad']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="text" class="form-control" id="Imagen" name="imagen" placeholder="Link de la imagen"
                    maxlength="255" value="<?= $imagen ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="categoria">Categoría<span class="required">*</span></label>
                <select class="form-control" id="categoria" name="categoria">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <?php foreach ($categorias as $categoriaItem): ?>
                    <option value="<?php echo $categoriaItem['Id_Categoria']; ?>"
                        <?php if ($categoria == $categoriaItem['Id_Categoria']) echo 'selected'; ?>>
                        <?php echo $categoriaItem['Descripcion']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errores['categoria'])): ?>
                <div class="text-danger"><?php echo $errores['categoria']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="subcategoria">Sub-Categoría<span class="required">*</span></label>
                <select class="form-control" id="subcategoria" name="subcategoria">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <?php foreach ($subcategorias as $subcategoriaItem): ?>
                    <option value="<?php echo $subcategoriaItem['id_SubCategoria']; ?>"
                        <?php if ($subcategoria == $subcategoriaItem['id_SubCategoria']) echo 'selected'; ?>>
                        <?php echo $subcategoriaItem['nombre']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errores['subcategoria'])): ?>
                <div class="text-danger"><?php echo $errores['subcategoria']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="proveedor">Proveedor<span class="required">*</span></label>
                <select class="form-control" id="proveedor" name="proveedor">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <?php foreach ($proveedores as $proveedorItem): ?>
                    <option value="<?php echo $proveedorItem['Id_Proveedor']; ?>"
                        <?php if ($proveedor == $proveedorItem['Id_Proveedor']) echo 'selected'; ?>>
                        <?php echo $proveedorItem['Nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errores['proveedor'])): ?>
                <div class="text-danger"><?php echo $errores['proveedor']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary color-boton">Añadir Producto</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>