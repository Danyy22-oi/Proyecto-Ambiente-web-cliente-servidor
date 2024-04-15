<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapateria</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <script src="https://kit.fontawesome.com/3c0d9a3fca.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/img/Logo.png" alt="Logo Zapateria" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="/">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/hombre.php">Hombre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/mujer.php">Mujer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/accesorios.php">Accesorios</a>
                        </li>
                        <?php
                        if (isset($_SESSION['rol']) && $_SESSION['rol'] === '1') {
                            echo '<li class="nav-item dropdown">' ;
                            echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                            echo 'Admin';
                            echo '</a>';
                            echo '<ul class="dropdown-menu dropdown-menu-light fade">';
                            echo '<li><a class="dropdown-item" href="/admin/usuarios.php">Usuarios</a></li>';
                            echo '<li><a class="dropdown-item" href="/admin/productos.php">Productos</a></li>';
                            echo '<li><a class="dropdown-item" href="/admin/categorias.php">Categorias</a></li>';
                            echo '<li><a class="dropdown-item" href="/subCategoria.php">Sub Categorias</a></li>';
                            echo '<li><a class="dropdown-item" href="/admin/proveedores.php">Proveedores</a></li>';
                            echo '</ul>';
                            echo '</li>';
                        }
                        ?>

                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 10rem;">
                        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
                        <li class="nav-item">
                            <span class="nav-link">Hola, <?= $_SESSION['nombre'] ?></span>
                        </li>
                        <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 10rem;">
                            <li class="nav-item">
                                <a class="nav-link" href="../carrito.php">
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                    <?php
                                    $cantidadCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
                                    ?>
                                    <span class="badge bg-danger"><?php echo $cantidadCarrito; ?></span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-user-circle fa-2x"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-light fade" style="min-width: auto;">
                                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
                                    <li><a class="dropdown-item"
                                            href="/pedidos.php?id=<?php echo $_SESSION['id']; ?>">Pedidos</a></li>
                                    <li><a class="dropdown-item"
                                            href="/Direcciones.php?id=<?php echo $_SESSION['id'] ?>">Direcciones</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="/DetallesCuenta.php?id=<?php echo $_SESSION['id'] ?>">Detalles de
                                            Cuenta</a></li>
                                    <li><a class="dropdown-item" href="/logout.php">Salir</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <?php if (!isset($_SESSION['login'])): ?>
                            <li class="nav-item">
                                <a href="login.php" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="registro.php" class="nav-link">Registro</a>
                            </li>
                            <?php endif; ?>
                        </ul>

                </div>
            </div>
        </nav>
    </header>
</body>