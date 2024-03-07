<?php

require_once "DAL/productosCrud.php";

$categorias = getArray("SELECT * FROM categorias");
$proveedores = getArray("SELECT * FROM proveedores");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $talla = $_POST['talla'];
    $imagen = $_POST['imagen'];
    $categoria = $_POST['categoria'];
    $proveedor = $_POST['proveedor'];

    if (AgregarProducto($nombre, $descripcion, $precio, $cantidad, $talla, $imagen, $categoria, $proveedor)) {
        echo "<div class='alert alert-success' role='alert'>Producto agregado correctamente.</div>";
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
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="255">
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="2" maxlength="255"></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio">
            </div>
            <br>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
            </div>
            <br>
            <div class="form-group">
                <label for="talla">Talla</label>
                <input type="number" class="form-control" id="talla" name="talla" placeholder="Talla">
            </div>
            <br>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="text" class="form-control" id="imagen" name="imagen" placeholder="Link de la imagen"
                    maxlength="255">
            </div>
            <br>
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select class="form-control" id="categoria" name="categoria">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['Id_Categoria'] ?>"><?= $categoria['Descripcion'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <select class="form-control" id="proveedor" name="proveedor">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <?php foreach ($proveedores as $proveedor): ?>
                    <option value="<?= $proveedor['Id_Proveedor'] ?>"><?= $proveedor['Nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
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