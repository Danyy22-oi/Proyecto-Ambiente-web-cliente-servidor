<!DOCTYPE html>
<html lang="en">
<?php
include_once "include/templates/header.php";
$errores = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once 'include/functions/recoge.php';
    $correo = recogePost("correo");
    $password = recogePost("password");
    //SANITIZAR LAS VARIABLES;
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    
    if(empty($correo)){
        $errores[] = 'No se digitó el correo del usuario';
    }
    if(empty($password)){
        $errores[] = 'No se digitó la constraseña';
    }
    if(empty($errores)){
        require_once "DAL/usuariosCrud.php";
        
        $query =  "select id_usuario, nombre, apellido ,correo, telefono, contrasena from usuario where correo = '$correo'";
        
        $mySession = getObject($query);
        if ($mySession != null){
            $auth = password_verify($password, $mySession['contrasena']);
            if($auth){
                session_start();
                $_SESSION['usuario'] = $mySession['correo'];
                $_SESSION['id'] = $mySession['id_usuario'];
                $_SESSION['login'] = $mySession['true'];
                header("Location: index.php");
            }else{
                $errores[] = "Contraseña incorrecta";
            }
        }else{
            $errores[] = "Usuario no existe";
        }
    
    }
}

?>
<main>
    <div>
        <h1>
            Iniciar Sesion
        </h1>
    </div>
    <ul>
        <?php
        foreach ($errores as $error) : ?>
            <li class='error' style="color: red;"><?php echo $error; ?></li>
        <?php
        endforeach;
        ?>
    </ul>

    <div>
        <h2>Acceso</h2>
        <p>Si ya tienes una cuenta, aqui puedes iniciar sesion</p>
        <form method="POST">
            <label for="correo">Correo Electronico</label>
            <input type="email" name="correo">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <button type="submit">
                INICIAR SESION
            </button>
        </form>
        <p>No tienes una Cuenta? Registrate <span><a href="">Aqui</a></span></p>
    </div>

</main>
<?php
include_once "include/templates/footer.php";
?>

</html>