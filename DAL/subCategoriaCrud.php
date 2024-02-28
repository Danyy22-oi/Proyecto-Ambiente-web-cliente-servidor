<?php

require_once "conexion.php";

function getArray($sql) {
    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            if(!$result = mysqli_query($oConexion, $sql)) die();
            $retorno = array();
            while ($row = mysqli_fetch_array($result)) {
                $retorno[] = $row;
            }
        }

    } catch (\Throwable $th) {

        echo $th;
    }finally{
        
        Desconectar($oConexion);
    }

    //return $retorno;
}

function getObject($sql){

    try{
        $oConexion = conectarDb();
        if(mysqli_set_charset($oConexion, "utf8")){
            if(!$result = mysqli_query($oConexion, $sql)) die();
            $retorno = null;
            while ($row = mysqli_fetch_array($result)){
                $retorno = $row;
            }

        }

    }catch(\Throwable $th){
        echo $th;

    }finally{
        Desconectar($oConexion);
    }

    return $retorno;
}

function agregarSubCategoria($pid_SubCategoria, $pnombre, $pid_producto) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("insert into subcategoria (id_SubCategoria, nombre, id_producto) values (?, ?, ?)");
            $stmt->bind_param("ssdisssi", $iid_SubCategoria, $inombre, $iid_producto);

            $iNombre = $pid_SubCategoria;
            $iDescripcion = $pnombre;
            $iPrecio = $pid_producto;
           

            if ($stmt->execute()){
                $retorno = true;
            }
        }

    } catch (\Throwable $th) {
        echo $th;
    }finally{
        Desconectar($oConexion);
    }

    return $retorno;
}

function EditarSubCategoria($pid_SubCategoria, $pnombre, $pid_producto) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("UPDATE id_SubCategoria SET Id_SubCategoria = ?, nombre = ?, Nombre = ?, id_producto = ?, id_producto = ?");
            $stmt->bind_param("ssdisssii", $iid_SubCategoria, $inombre, $iid_producto);

            $iIdProducto = $pid_SubCategoria;
            $iNombre = $pnombre;
            $iDescripcion = $pid_producto;
            

            if ($stmt->execute()){
                $retorno = true;
            }
        }

    } catch (\Throwable $th) {
        echo $th;
    } finally {
        Desconectar($oConexion);
    }

    return $retorno;
}

function EliminarSubCategoria($pId) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("delete from tabla_subcategoria where id_SubCategoria = ?");
            $stmt->bind_param("i", $iId);

            $iId = $pId;

            if ($stmt->execute()){
                $retorno = true;
            }
        }

    } catch (\Throwable $th) {

        echo $th;
    }finally{
        Desconectar($oConexion);
    }

    return $retorno;
}

?>