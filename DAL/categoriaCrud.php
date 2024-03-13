<?php


include_once 'include/templates/header.php';

require_once "conexion.php";


function agregarCategororia ($pCategoria){
    $retorno = false;
    $oConexion = conectarDb();
    try{

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("INSERT INTO categorias (Descripcion) VALUES (?)");
            $stmt ->bind_param("s", $iCategoria);
            $iCategoria = $pCategoria;

            if($stmt->execute()){
                return true;
            }else{
                throw new Exception("Error al insertar la categoria". $stmt->error);
            }
        }

    }catch(Throwable $th){
        error_log(
            "Error al insertar Categoria". $th->getMessage()
        );
    }finally{
        Desconectar($oConexion);
    }

}

function actualizarCategoria($pIdCategoria, $pDescripcion){
    $retorno = false;
    $oConexion = conectarDb();
    try{

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("UPDATE categorias SET Descripcion = ? WHERE Id_Categoria = ?");
            $stmt->bind_param("si", $iDescripcion, $iIdCategoria);

            $iIdCategoria = $pIdCategoria;
            $iDescripcion = $pDescripcion;
            
            if($stmt->execute()){
                return true;
            }else{
                throw new Exception("Error al actualizar la categoría: " . $stmt->error);
            }
        }

    }catch(Throwable $th){
        error_log(
            "Error al actualizar la categoría: " . $th->getMessage()
        );
    }finally{
        desconectar($oConexion);
    }
}

function eliminarCategoria($pIdCategoria){
    $retorno = false;
    $oConexion = conectarDb();
    try {
        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmt = $oConexion->prepare("DELETE from categorias where Id_Categoria = ?"); 
            if ($stmt) {
                $stmt->bind_param("i", $idCategoria);
                $idCategoria = $pIdCategoria;
                if($stmt->execute()){
                    $retorno = true;
                }
            } else {

                error_log("Error preparing statement: " . $oConexion->error);
            }
        } else {

            error_log("Error setting charset: " . mysqli_error($oConexion));
        }
    } catch (\Throwable $th) {
        error_log("Error al eliminar el Categoria: " . $th->getMessage());
    } finally {

        $oConexion->close();
    }
    return $retorno;
}





function getArray($sql)
{
    try {
        $oConexion = conectarDb();

        if (mysqli_set_charset($oConexion, "utf8")) {
            if (!$result = mysqli_query($oConexion, $sql)) {
                throw new Exception("Error en la consulta SQL: " . mysqli_error($oConexion));
            }
            $retorno = array();
            while ($row = mysqli_fetch_array($result)) {
                $retorno[] = $row;
            }
            return $retorno;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        Desconectar($oConexion);
    }
}

function getObject($sql)
{

    try {
        $oConexion = conectarDb();
        if (mysqli_set_charset($oConexion, "utf8")) {
            if (!$result = mysqli_query($oConexion, $sql)) {
                throw new Exception("Error en la consulta SQL: " . mysqli_error($oConexion));
            }
            $retorno = null;
            while ($row = mysqli_fetch_array($result)) {
                $retorno = $row;
            }
            return $retorno;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        Desconectar($oConexion);
    }
}
