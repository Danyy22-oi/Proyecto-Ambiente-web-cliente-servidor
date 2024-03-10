<?php

require_once "DAL/productosCrud.php";

$categorias = getArray("SELECT * FROM categorias");
$subcategorias = getArray("SELECT * FROM subcategoria");
$proveedores = getArray("SELECT * FROM proveedores");

$errores = array();
$nombre = $descripcion = $precio = $cantidad = $talla = $imagen = $categoria = $proveedor = $subcategoria = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';
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
            if (AgregarProducto($nombre, $descripcion, $precio, $cantidad, $talla, $imagen, $categoria, $subcategoria, $proveedor)) {
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
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="255"
                    value="<?php echo htmlspecialchars($nombre); ?>">
                <?php if (!empty($errores['nombre'])): ?>
                <div class="text-danger"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="2"
                    maxlength="255"><?php echo htmlspecialchars($descripcion); ?></textarea>
                <?php if (!empty($errores['descripcion'])): ?>
                <div class="text-danger"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio"
                    value="<?php echo htmlspecialchars($precio); ?>">
                <?php if (!empty($errores['precio'])): ?>
                <div class="text-danger"><?php echo $errores['precio']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
            </div>
            <br>
            <div class="form-group">
                <label for="talla">Talla</label>
                <input type="number" class="form-control" id="talla" name="talla" placeholder="Talla"
                    value="<?php echo htmlspecialchars($talla); ?>">
                <?php if (!empty($errores['talla'])): ?>
                <div class="text-danger"><?php echo $errores['talla']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="text" class="form-control" id="imagen" name="imagen" placeholder="Link de la imagen"
                    maxlength="255" value="<?php echo htmlspecialchars($imagen); ?>">
                <?php if (!empty($errores['imagen'])): ?>
                <div class="text-danger"><?php echo $errores['imagen']; ?></div>
                <?php endif; ?>
            </div>
            <br>
            <div class="form-group">
                <label for="categoria">Categoría</label>
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
                <label for="subcategoria">Sub-Categoría</label>
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
                <label for="proveedor">Proveedor</label>
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

</html>