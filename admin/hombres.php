<?php
$login = false;
require_once "../include/functions/recoge.php";
$ingreso = recogeGet("ingreso");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
}
?>

<?php
    require_once "../DAL/hombreCrud.php";
    $elSQL = "select id_hombre, marca, descripcion, talla, precio, imagen from hombre";
    $myArray = getArray($elSQL);
?>

    <h2>Zapatos de hombre</h2>

    <?php 
    if(!empty($myArray)){
    foreach ($myArray as $value) { ?>

    <div class="contenedor_Zapatos">
        <div class="card">
            <?php echo "<td><img width = 250 height = 200 src='{$value['imagen']}'></td>";?>
            <div class="card-content">
                <h4><?php echo $value["marca"]; ?> </h5>
                <p><?php echo $value["descripcion"]; ?> </p>
                <p><?php echo $value["talla"]; ?> </p>
                <p> ₡ <?php echo $value["precio"]; ?></p>
            </div>
        </div>
    </div>
    <?php }
        } ?>