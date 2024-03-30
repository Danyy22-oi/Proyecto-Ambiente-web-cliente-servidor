<?php
include_once "../include/functions/autenticado.php";

verificarAutenticacion();
include_once "../include/functions/recoge.php";
$ingreso = recogeGET("ingreso");
require_once "../DAL/categoriaCrud.php";
$elSQL = "SELECT  *from categorias";
$categorias = getArray($elSQL);
$errores =  []; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id =  recogePost("id");
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {
        include_once "../DAL/categoriaCrud.php";
        if (eliminarCategoria($id)) {
            header("Location: /admin/categorias.php?ingreso=2");
        }else {
            $errores [] = "Error al eliminar categoria, tiene productos relacionados ";
        }
    }
}

include_once "../include/templates/header.php";
?>
<main>

    <div class="container">
        <div>

            <div style="float: right;">
                <a href="/admin/cruds/agregarCategoria.php">
                    <button type="button" class="btn btn-success color-boton ">Añadir Categoria</button>
                </a>
            </div>
        </div>
        <div>
            <h2>Categorias</h2>
            <?php foreach($errores as $error): ?>
                <div class='alert alert-danger' role='alert'><?php echo $error?>.</div>
            <?php endforeach; ?>
            <p class="text-success"><?= $ingreso == 1 ? "Se actualizó la categoría correctamente" : ""; ?></p>
            <p class="text-success"><?= $ingreso == 2 ? "Se eliminó la categoría correctamente" : ""; ?></p>
            <p class="text-success"><?= $ingreso == 3 ? "Se agregó la categoría correctamente" : ""; ?></p>
            <?php if (!empty($categorias)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria) : ?>
                            <tr>
                                <td><?php echo $categoria['Id_Categoria']; ?></td>
                                <td><?php echo $categoria['Descripcion']; ?></td>
                                <td>
                                    <a href="cruds/actualizarCategoria.php?id=<?= $categoria['Id_Categoria'] ?>" class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                                    <form method="post" style="display: inline;">
                                        <form method="post" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= $categoria['Id_Categoria'] ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta categoria?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <input type="hidden" name="action" value="eliminar_SubCategoria">
                                        </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>

                <p colspan='6'>No hay registros de Categorias</p>

            <?php endif; ?>
        </div>
    </div>
</main>
<?php
include_once "../include/templates/footer.php";

?>