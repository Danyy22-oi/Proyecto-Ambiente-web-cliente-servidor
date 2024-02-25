<?php 
require_once "conexion.php";

function registrarUsuario($pNombre, $pApellido, $pCorreo, $pTelefono, $pPassword, $pRol){
    $retorno = false;
    $oConexion = conectarDb();
    
    try{
        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("INSERT INTO usuario(nombre, apellido, correo, telefono, contrasena, id_rol) values (?,?,?,?,?,?)");
            $stmt -> bind_param("sssssi", $iNombre, $iApellido, $iCorreo, $iTelefono,$iPassword,$iRol);
            $iNombre= $pNombre;
            $iApellido = $pApellido;
            $iCorreo = $pCorreo;
            $iTelefono = $pTelefono;
            $iPassword = $pPassword;
            $iRol = $pRol;
            if($stmt->execute()){
                $retorno = true;
            }


        }
    }catch(\Throwable $th){
        error_log("Error al registrar el usuario" . $th->getMessage());
    }finally{
        Desconectar($oConexion);
    }
    return $retorno;
}

function actualizarUsuario($pNombre, $pApellido, $pCorreo, $pTelefono, $pRol,$idUsuario) {
    $retorno = false;
    $oConexion = conectarDb();
    try {
        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmt = $oConexion->prepare("UPDATE usuario SET nombre = ?, apellido = ?, correo = ?, telefono = ?, id_rol = ? WHERE id_usuario = ?");
            if ($stmt) {
                $stmt->bind_param("ssssii", $iNombre, $iApellido, $iCorreo, $iTelefono, $iRol,  $idUsuario);
                $iNombre = $pNombre;
                $iApellido = $pApellido;
                $iCorreo = $pCorreo;
                $iTelefono = $pTelefono;
                $iRol = $pRol;
                $idUsuario = $idUsuario; // Assuming $pIdUsuario is passed to the function
                if ($stmt->execute()) {
                    $retorno = true;
                }
            } else {
                // Handle statement preparation failure
                error_log("Error preparing statement: " . $oConexion->error);
            }
        } else {
            // Handle charset setting failure
            error_log("Error setting charset: " . mysqli_error($oConexion));
        }
    } catch (\Throwable $th) {
        error_log("Error al actualizar el usuario: " . $th->getMessage());
    } finally {
        // Close the connection
        $oConexion->close();
    }
    return $retorno;
}

function eliminarUsuario($pIdUsuario){
    $retorno = false;
    $oConexion = conectarDb();
    try {
        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmt = $oConexion->prepare("DELETE from usuario where id_usuario = ?"); 
            if ($stmt) {
                $stmt->bind_param("i", $idUsuario);
                $idUsuario = $pIdUsuario;
                if($stmt->execute()){
                    $retorno = true;
                }
            } else {
                // Handle statement preparation failure
                error_log("Error preparing statement: " . $oConexion->error);
            }
        } else {
            // Handle charset setting failure
            error_log("Error setting charset: " . mysqli_error($oConexion));
        }
    } catch (\Throwable $th) {
        error_log("Error al eliminar el usuario: " . $th->getMessage());
    } finally {
        // Close the connection
        $oConexion->close();
    }
    return $retorno;
}

function getArray($sql){
    try{
        $oConexion = conectarDb();
        //Cambio a formato utf8
        if(mysqli_set_charset($oConexion, "utf8")){
            if(!$result = mysqli_query($oConexion, $sql)) die();// cancela la ejecucion
            $retorno = array();
            while($row = mysqli_fetch_array($result)){
                $retorno[] = $row;
            }
        }
    }catch (\Throwable $th){
        //almacenar informacion en bitacora $th
        echo $th;
    }finally{
        Desconectar($oConexion);
    }

    return $retorno;
}

//tambien podemos obtener un objeto
function getObject($sql){
    try{
        $oConexion = conectarDb();
        //Formato de datos utf8
        if(mysqli_set_charset($oConexion, "utf8")){
            if(!$result = mysqli_query($oConexion, $sql)) die();  //cancela la ejecución
            $retorno = null;
            while ($row = mysqli_fetch_array($result)) {
                $retorno = $row;
            }

        }
    }catch(\Throwable $th){
              //almacenar información en bitacora $th
        //throw $th;
        echo $th;
    }finally{
        Desconectar($oConexion);
    }
    return $retorno;
}


?>