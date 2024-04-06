<?php
include_once "include/functions/autenticado.php";

verificarAutenticacion();
require_once "DAL/subCategoriaCrud.php";

$elSQL = "SELECT * FROM subcategoria";
$subCategorias = getArray($elSQL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'eliminar_SubCategoria') {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (EliminarSubCategoria($id)) {
                header("Location: subCategoria.php");
            } else {
                $errores[] = "Error al eliminar la subcategoría, tiene productos relacionados.";
            }
        } else {
            $errores[] = "ID de subcategoría no recibido.";
        }
    }
}

include_once 'include/templates/header.php';
?>

<main>
    <div class="container">
        <div style="float: right;">
            <a href="agregarSubCategoria.php">
                <button type="button" class="btn btn-success color-boton">Añadir SubCategoria</button>
            </a>
        </div>
        <div>
            <h2>Sub categorías</h2>
            <?php if (!empty($subCategorias)) : ?>
            <table class="table">
                <thead style="text-align: center;">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subCategorias as $subCategoria) : ?>
                    <tr>
                        <td><?= $subCategoria['nombre'] ?></td>
                        <td><?= $subCategoria['descripcion'] ?></td>
                        <td style="text-align: center;">
                            <a href="actualizarSubCategoria.php?id=<?= $subCategoria['id_SubCategoria'] ?>"
                                class="btn btn-primary mr-1"><i class="fas fa-edit"></i></a>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $subCategoria['id_SubCategoria'] ?>">
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Está seguro de que desea eliminar esta subcategoría?');">
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
            <p>No hay registros de subcategorías.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
include_once 'include/templates/footer.php';
?>