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

    return $retorno;
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

function AgregarProveedores($pNombre, $pLogo) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("insert into proveedores (Nombre, Logo) values (?, ?)");
            $stmt->bind_param("ss", $iNombre, $iLogo);

            $iNombre = $pNombre;
            $iLogo = $pLogo;

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

function EditarProveedores($pId_Proveedor, $pNombre, $pLogo) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("UPDATE proveedores SET Nombre = ?, Logo = ? WHERE Id_Proveedor= ?");
            $stmt->bind_param("ssi", $iNombre, $iLogo, $iId_Proveedor);

            $iId_Proveedor = $pId_Proveedor;
            $iNombre = $pNombre;
            $iLogo = $pLogo;

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

function EliminarProveedores($pId_Proveedor) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("delete from proveedores where Id_Proveedor = ?");
            $stmt->bind_param("i", $iId_Proveedor);

            $iId_Proveedor = $pId_Proveedor;

            if ($stmt->execute()){
                $retorno = true;
            }
        }

    } catch (\Throwable $th) {
        
        //echo $th;
    }finally{
        Desconectar($oConexion);
    }

    return $retorno;
}

?>