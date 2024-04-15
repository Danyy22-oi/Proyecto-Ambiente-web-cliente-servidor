<?php
include_once "include/templates/header.php";
require_once "DAL/productosCrud.php";

function existeProducto($idProducto) {
    try {
        $oConexion = conectarDb();
        $stmt = $oConexion->prepare("SELECT Id_Producto FROM productos WHERE Id_Producto = ?");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $stmt->store_result();
        
        $existe = $stmt->num_rows > 0;
        
        $stmt->close();
        Desconectar($oConexion);

        return $existe;
    } catch (\Throwable $th) {
        return false;
    }
}

function existeTalla($idTalla) {
    try {
        $oConexion = conectarDb();
        $stmt = $oConexion->prepare("SELECT Id_Talla FROM tallas WHERE Id_Talla = ?");
        $stmt->bind_param("i", $idTalla);
        $stmt->execute();
        $stmt->store_result();
        
        $existe = $stmt->num_rows > 0;
        
        $stmt->close();
        Desconectar($oConexion);

        return $existe;
    } catch (\Throwable $th) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    } else {
        $idUsuario = $_SESSION['id'];

        if (IngresarPedido($_SESSION['carrito'], $idUsuario)) {
            echo "<div class='alert alert-success text-center' role='alert'>Pedido realizado con éxito.</div>";
            foreach ($_SESSION['carrito'] as $producto) {
                $idProducto = $producto['id_producto'];
                $idTalla = $producto['id_talla'];
                $cantidad = 1;

                if (existeProducto($idProducto) && existeTalla($idTalla)) {
                    RestarCantidadProductoCarrito($idProducto, $idTalla);
                } else {
                    echo "<div class='alert alert-danger text-center' role='alert'>Error al editar producto: Producto o talla no encontrados.</div>";
                }
            }
            unset($_SESSION['carrito']);
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>Hubo un error al procesar el pedido.</div>";
        }
        
    }
}

?>
<main>
    <div class="container">
        <br>
        <?php
        $idUsuario = $_SESSION['id'];
        $elSQL = "SELECT f.*, p.Nombre AS Nombre_Producto 
        FROM facturas f 
        INNER JOIN productos p ON f.Id_Producto = p.Id_Producto
        WHERE f.id_usuario = $idUsuario"; 
        $facturas = getArray($elSQL);
        
        if (!empty($facturas)) {
        ?>
        <h2>Pedidos</h2>
        <div class="container">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Nombre del Producto</th>
                        <th scope="col">Fecha de compra</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    foreach ($facturas as $factura) {
                        echo "<tr>";
                        echo "<td>" . $factura['Nombre_Producto'] . "</td>";
                        echo "<td>" . date('d \d\e F \d\e\l Y', strtotime($factura['Fecha'])) . "</td>";
                        echo "<td>₡" . $factura['Precio'] . "</td>";
                        echo "<td>Pendiente</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        } else {
            echo "<p class='text-center'>No hay registros de pedidos</p>";
        }
        ?>
    </div>
</main>
<?php
include_once "include/templates/footer.php";
?>

</html>
