<!DOCTYPE html>
<html lang="en">
<?php
include_once "../../include/templates/headerAdmin.php";

?>
<main>
    <h1>Eliminar Producto</h1>
    <div>
        <form method="POST">
            <h2>Desea eliminar este Producto?</h2>
            <button type="submit">SI</button>
            <a href="../productos.php">NO</a>
        </form>
    </div>
</main>
<?php
include_once "../../include/templates/footer.php";

?>
</html>