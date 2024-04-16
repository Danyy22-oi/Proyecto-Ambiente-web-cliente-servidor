<?php

include_once "include/functions/autenticado.php";

$auth = estaAutenticado();
if($auth){
    header('Location: /');
}


$errores = array();
$correo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'include/functions/recoge.php';
    $correo = recogePost("correo");
    $password = recogePost("password");
    //SANITIZAR LAS VARIABLES;
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

    if (empty($correo)) {
        $errores['correo'] = 'No se digitó el correo del usuario';
    }
    if (empty($password)) {
        $errores['password'] = 'No se digitó la contraseña';
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
                $_SESSION['nombre'] = $mySession ['nombre'];
                header("Location: index.php");
                exit;
            } else {
                $errores['password'] = "Correo o contraseña incorrecta";
            }
        } else {
            $errores['password'] = "Correo o contraseña incorrecta";
        }
    }
}
include_once "include/templates/header.php";
?>
<main>
    <div class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div>
                        <h1 class="text-center colorPrincipal">Iniciar Sesión</h1>
                        <p class="text-center">Si ya tienes una cuenta, aquí puedes iniciar sesión</p>
                        <form method="POST">
                            <div class="mb-4">
                                <label class="form-label" for="correo">Correo Electrónico</label>
                                <input type="email" id="correo" name="correo" class="form-control form-control-sm <?php echo isset($errores['correo']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($correo); ?>" />
                                <?php if (isset($errores['correo'])) : ?>
                                    <div class="invalid-feedback"><?php echo $errores['correo']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="password">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control form-control-sm <?php echo isset($errores['password']) ? 'is-invalid' : ''; ?>" />
                                <?php if (isset($errores['password'])) : ?>
                                    <div class="invalid-feedback"><?php echo $errores['password']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- <div class="row mb-4">
                                <div class="col">
                                    <a href="#!" class="d-block text-center">Olvidaste tu contraseña?</a>
                                </div>
                            </div> -->

                            <div class="text-center mb-2">
                                <button type="submit" class="btn btnInicio-Registro btn-block">Iniciar Sesión</button>
                            </div>
                        </form>
                        <p class="text-center">¿No tienes una cuenta? Regístrate <span><a href="registro.php">aquí</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once "include/templates/footer.php";
?>
