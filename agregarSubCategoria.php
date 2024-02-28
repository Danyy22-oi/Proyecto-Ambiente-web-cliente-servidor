<?php
include_once 'include/templates/header.php';
require_once "DAL/SubCategoriaCrud.php";

$subcategoria = getArray("SELECT * FROM subcategoria");
$productos = getArray("SELECT * FROM productos");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_SubCategoria = $_POST['id_SubCategoria'];
    $nombre = $_POST['nombre'];
    $id_producto = $_POST['id_producto'];
  

    if (agregarSubCategoria($id_SubCategoria, $nombre, $id_producto)) {
        echo "<div class='alert alert-success' role='alert'>Sub categoria agregada correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al agregar la sub categoria.</div>";
    }
}
?>

<main>
    <div class="container">
        <h2>Nueva Sub Categoria</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="id_SubCategoria">Id_SubCategoria</label>
                <input type="text" class="form-control" id="id_SubCategoria" name="id_SubCategoria" maxlength="255">
            </div>
            <br>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" maxlength="255">
            </div>
            <br>
            <div class="form-group">
                <label for="id_producto">Id Producto</label>
                <select class="form-control" id="id_producto" name="id_producto">
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
           
            <div>
                <button type="submit" class="btn btn-primary color-boton">Añadir Sub Categoria</button>
            </div>
        </form>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>

</html>