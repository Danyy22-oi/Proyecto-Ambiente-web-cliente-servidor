<?php 
require_once "conexion.php";

function registrarhombre($pMarca, $pDescripcion, $pTalla, $pPrecio, $pImagen){
    $retorno = false;
    $oConexion = conectarDb();
    
    try{
        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("INSERT INTO hombre(marca, descripcion, talla, precio, imagen) values (?,?,?,?,?)");
            $stmt -> bind_param("sssis", $iMarca, $iDescripcion, $iTalla, $iPrecio,$iImagen);
            $iMarca= $pMarca;
            $iDescripcion = $pDescripcion;
            $iTalla = $pTalla;
            $iPrecio = $pPrecio;
            $iImagen = $pImagen;
            if($stmt->execute()){
                $retorno = true;
            }


        }
    }catch(\Throwable $th){
        error_log("Error al registrar el zapato de hombre" . $th->getMessage());
    }finally{
        Desconectar($oConexion);
    }
    return $retorno;
}

function actualizarHombre($pMarca, $pDescripcion, $pTalla, $pPrecio, $pImagen, $pId_hombre) {
    $retorno = false;
    $oConexion = conectarDb();
    try {
        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmt = $oConexion->prepare("UPDATE usuario SET marca = ?, descripcion = ?, talla = ?, precio = ?, imagen = ? WHERE id_hombre = ?");
            if ($stmt) {
                $stmt->bind_param("sssisi", $iMarca, $iDescripcion, $iTalla, $iPrecio,$iImagen,$iId_hombre);
                $iMarca = $pMarca;
                $iDescripcion = $pDescripcion;
                $iTalla = $pTalla;
                $iPrecio = $pPrecio;
                $iImagen = $pImagen;
                $pId_hombre = $pId_hombre; // Assuming $pIdUsuario is passed to the function
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
        error_log("Error al actualizar el zapato de hombre: " . $th->getMessage());
    } finally {
        // Close the connection
        $oConexion->close();
    }
    return $retorno;
}

function eliminarhombre($pId_hombre){
    $retorno = false;
    $oConexion = conectarDb();
    try {
        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmt = $oConexion->prepare("DELETE from hombre where id_hombre = ?"); 
            if ($stmt) {
                $stmt->bind_param("i", $id_hombre);
                $id_hombre = $pId_hombre;
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
        error_log("Error al eliminar el zapato de hombre: " . $th->getMessage());
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