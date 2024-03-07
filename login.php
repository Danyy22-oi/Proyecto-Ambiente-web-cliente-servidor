<?php
session_start();

$errores = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'include/functions/recoge.php';
    $correo = recogePost("correo");
    $password = recogePost("password");
    //SANITIZAR LAS VARIABLES;
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

    if (empty($correo)) {
        $errores[] = 'No se digitó el correo del usuario';
    }
    if (empty($password)) {
        $errores[] = 'No se digitó la constraseña';
    }
    if (empty($errores)) {

        require_once "DAL/usuariosCrud.php";

        $query =  "select id_usuario, nombre, apellido ,correo, telefono, contrasena,  id_rol from usuario where correo = '$correo'";

        $mySession = getObject($query);
        if ($mySession != null) {
            $auth = password_verify($password, $mySession['contrasena']);
            if ($auth) {
                $_SESSION['usuario'] = $mySession['correo'];
                $_SESSION['rol'] = $mySession['id_rol'];
                $_SESSION['id'] = $mySession['id_usuario'];
                $_SESSION['login'] = true; 
                header("Location: index.php");
                exit;
            } else {
                $errores[] = "Contraseña incorrecta";
            }
        } else {
            $errores[] = "Usuario no existe";
        }
    }
}
include_once "include/templates/header.php";
?>
<main>
    <div class="banner">

        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div>
                        <h1 class="text-center colorPrincipal">Iniciar Sesion</h1>
                        <ul class="list-unstyled">
                            <?php
                            foreach ($errores as $error) : ?>
                                <li class='error text-center' style="color: red;"><?php echo $error; ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                        <h2 class="text-center">Acceso</h2>
                        <p class="text-center">Si ya tienes una cuenta, aquí puedes iniciar sesión</p>
                        <form method="POST">
                            <!-- Email input -->
                            <div class="mb-4">
                                <label class="form-label" for="correo">Email address</label>
                                <input type="email" id="correo" name="correo" class="form-control form-control-sm" />
                            </div>

                            <!-- Password input -->
                            <div class="mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-sm" />
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                                <div class="col">
                                    <!-- Simple link -->
                                    <a href="#!" class="d-block text-center">Olvidaste tu contraseña?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="text-center mb-2">
                                <button type="submit" class="btn btnInicio-Registro btn-block ">Inciar Sesion</button>
                            </div>
                        </form>
                        <p class="text-center">No tienes una cuenta? Regístrate <span><a href="registro.php">aquí</a></span></p>
                    </div>
                </div>
            </div>
        </div>
</main>

<?php
include_once "include/templates/footer.php";
?>