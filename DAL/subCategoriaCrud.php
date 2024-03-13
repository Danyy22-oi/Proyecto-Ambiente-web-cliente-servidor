<?php
include_once 'include/templates/header.php';
require_once "DAL/subCategoriaCrud.php";
require_once "conexion.php";

function getArray($sql) {
    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            if(!$result = mysqli_query($oConexion, $sql)) {
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

function getObject($sql){

    try{
        $oConexion = conectarDb();
        if(mysqli_set_charset($oConexion, "utf8")){
            if(!$result = mysqli_query($oConexion, $sql)) {
                throw new Exception("Error en la consulta SQL: " . mysqli_error($oConexion));
            }
            $retorno = null;
            while ($row = mysqli_fetch_array($result)){
                $retorno = $row;
            }
            return $retorno;
        }

    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        Desconectar($oConexion);
    }
}


function agregarSubCategoria($pnombre, $pid_producto) {
    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("INSERT INTO subcategoria (nombre, id_producto) VALUES (?, ?)");
            $stmt->bind_param("si", $inombre, $iid_producto);

            $inombre = $pnombre;
            $iid_producto = $pid_producto;

            if ($stmt->execute()){
                return true;
            } else {
                throw new Exception("Error al insertar la subcategoría: " . $stmt->error);
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    } finally {
        Desconectar($oConexion);
    }
}

function EditarSubCategoria($pid_SubCategoria, $pnombre, $pid_producto) {
    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("UPDATE subcategoria SET nombre = ?, id_producto = ? WHERE id_SubCategoria = ?");
            $stmt->bind_param("sii", $inombre, $iid_producto, $pid_SubCategoria);

            $inombre = $pnombre;
            $iid_producto = $pid_producto;

            if ($stmt->execute()){
                return true;
            } else {
                throw new Exception("Error al editar la subcategoría: " . $stmt->error);
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    } finally {
        Desconectar($oConexion);
    }
}

function EliminarSubCategoria($pId) {
    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("DELETE FROM subcategoria WHERE id_SubCategoria = ?");
            $stmt->bind_param("i", $pId);

            if ($stmt->execute()){
                return true;
            } else {
                throw new Exception("Error al eliminar la subcategoría: " . $stmt->error);
            }
        }

    } catch (Exception $e) {
        //echo $e->getMessage();
        return false;
    } finally {
        Desconectar($oConexion);
    }
}

?>