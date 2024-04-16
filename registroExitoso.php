<!DOCTYPE html>
<html lang="en">
<?php
include_once "include/templates/header.php";
include_once "include/functions/autenticado.php";
$auth = estaAutenticado();
if ($auth) {
    header('Location: /');
}

?>
<main>
    <div>
        <h1>
            REGISTRO EXITOSO
        </h1>
    </div>
</main>
<?php
include_once "include/templates/footer.php";
?>

</html>