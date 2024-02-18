<!DOCTYPE html>
<html lang="en">
<?php
include_once "include/templates/header.php";
?>
<main>
    <div>
        <h1>Mi Cuenta</h1>
    </div>
    <div>
        <div>
            <H3>Panel de Control</H3>
            <div>
                <ul>
                    <li>
                        <a href="#">
                            <h4>
                                Escritorio
                            </h4>
                        </a>


                    </li>
                    <li>
                        <a href="pedidos.php">
                            <h4>
                                Pedidos
                            </h4>
                        </a>

                    </li>
                    <li>
                        <a href="direcciones.php">
                            <h4>
                                Direcciones
                            </h4>
                        </a>

                    </li>
                    <li>
                        <a href="detallesCuenta.php">
                            <h4>
                                Detalles de Cuenta
                            </h4>
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <h4>
                                Log Out
                            </h4>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
        <div>
            <p>
                Mensaje al usuario
            </p>
        </div>
    </div>
</main>
<?php
include_once "include/templates/footer.php";
?>

</html>