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

function AgregarProducto($pNombre, $pDescripcion, $pPrecio, $pCantidad, $pTalla, $pImagen, $pCategoria, $pSubcategoria, $pProveedor) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("INSERT INTO productos (Nombre, Descripcion, Precio, Cantidad, Talla, Imagen, Id_Categoria, Id_Subcategoria, Id_Proveedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssddssiii", $iNombre, $iDescripcion, $iPrecio, $iCantidad, $iTalla, $iImagen, $iIdCategoria, $iIdSubcategoria, $iIdProveedor);

            $iNombre = $pNombre;
            $iDescripcion = $pDescripcion;
            $iPrecio = $pPrecio;
            $iCantidad = $pCantidad;
            $iTalla = $pTalla;
            $iImagen = $pImagen;
            $iIdCategoria = $pCategoria;
            $iIdSubcategoria = $pSubcategoria;
            $iIdProveedor = $pProveedor;

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


function EditarProducto($pIdProducto, $pNombre, $pDescripcion, $pPrecio, $pCantidad, $pTalla, $pImagen, $pCategoria, $pSubcategoria, $pProveedor) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Cantidad = ?, Talla = ?, Imagen = ?, Id_Categoria = ?, Id_Subcategoria = ?, Id_Proveedor = ? WHERE Id_Producto = ?");
            $stmt->bind_param("ssdisssiii", $iNombre, $iDescripcion, $iPrecio, $iCantidad, $iTalla, $iImagen, $iIdCategoria, $iIdSubcategoria, $iIdProveedor, $iIdProducto);

            $iIdProducto = $pIdProducto;
            $iNombre = $pNombre;
            $iDescripcion = $pDescripcion;
            $iPrecio = $pPrecio;
            $iCantidad = $pCantidad;
            $iTalla = $pTalla;
            $iImagen = $pImagen;
            $iIdCategoria = $pCategoria;
            $iIdSubcategoria = $pSubcategoria;
            $iIdProveedor = $pProveedor;

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


function EliminarProducto($pId) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("delete from productos where Id_Producto = ?");
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