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

function AgregarProducto($pNombre, $pDescripcion, $pPrecio, $pImagen, $pCategoria, $pSubcategoria, $pProveedor) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmtProductos = $oConexion->prepare("INSERT INTO productos (Nombre, Descripcion, Precio, Imagen, Id_Categoria, Id_Subcategoria, Id_Proveedor) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmtProductos->bind_param("ssdsiii", $iNombre, $iDescripcion, $iPrecio, $iImagen, $iIdCategoria, $iIdSubcategoria, $iIdProveedor);

            $iNombre = $pNombre;
            $iDescripcion = $pDescripcion;
            $iPrecio = $pPrecio;
            $iImagen = $pImagen;
            $iIdCategoria = $pCategoria;
            $iIdSubcategoria = $pSubcategoria;
            $iIdProveedor = $pProveedor;

            if ($stmtProductos->execute()) {
                $stmtProductos->close();
                $retorno = true;
            } else {
                echo "Error al insertar en la tabla productos.";
            }
        }
    } catch (\Throwable $th) {
        echo $th;
    } finally {
        Desconectar($oConexion);
    }

    return $retorno;
}

function EditarProducto($pIdProducto, $pNombre, $pDescripcion, $pPrecio, $pImagen, $pCategoria, $pSubcategoria, $pProveedor) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if(mysqli_set_charset($oConexion, "utf8")){
            $stmt = $oConexion->prepare("UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Imagen = ?, Id_Categoria = ?, Id_Subcategoria = ?, Id_Proveedor = ? WHERE Id_Producto = ?");
            $stmt->bind_param("ssdsiiii", $iNombre, $iDescripcion, $iPrecio, $iImagen, $iIdCategoria, $iIdSubcategoria, $iIdProveedor, $iIdProducto);

            $iIdProducto = $pIdProducto;
            $iNombre = $pNombre;
            $iDescripcion = $pDescripcion;
            $iPrecio = $pPrecio;
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

function obtenerIdProducto() {
    $idProducto = null;
    try {
        $oConexion = conectarDb();

        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmt = $oConexion->prepare("SELECT MAX(Id_Producto) AS id FROM productos");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $idProducto = $row['id'];
            }
            $stmt->close();
        }
    } catch (\Throwable $th) {
        echo $th;
    } finally {
        Desconectar($oConexion);
    }
    return $idProducto;
}

function AgregarProductoTalla($idProducto, $idTalla, $cantidad) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmtTallas = $oConexion->prepare("INSERT INTO producto_talla (Id_Producto, Id_Talla, Cantidad) VALUES (?, ?, ?)");
            $stmtTallas->bind_param("iis", $idProducto, $idTalla, $cantidad);

            if ($stmtTallas->execute()) {
                $stmtTallas->close();
                $retorno = true;
            } else {
                echo "Error al insertar en la tabla producto_talla.";
            }
        }
    } catch (\Throwable $th) {
        echo $th;
    } finally {
        Desconectar($oConexion);
    }

    return $retorno;
}

function EditarProductoTalla($idProducto, $idTalla, $cantidad) {
    $retorno = false;

    try {
        $oConexion = conectarDb();

        if (mysqli_set_charset($oConexion, "utf8")) {
            $stmtVerificar = $oConexion->prepare("SELECT Id_Producto FROM producto_talla WHERE Id_Producto = ? AND Id_Talla = ?");
            $stmtVerificar->bind_param("ii", $idProducto, $idTalla);
            $stmtVerificar->execute();
            $stmtVerificar->store_result();

            if ($stmtVerificar->num_rows > 0) {
                $stmtTallas = $oConexion->prepare("UPDATE producto_talla SET Cantidad = ? WHERE Id_Producto = ? AND Id_Talla = ?");
                $stmtTallas->bind_param("iii", $cantidad, $idProducto, $idTalla);
            } else {
                $stmtTallas = $oConexion->prepare("INSERT INTO producto_talla (Id_Producto, Id_Talla, Cantidad) VALUES (?, ?, ?)");
                $stmtTallas->bind_param("iii", $idProducto, $idTalla, $cantidad);
            } if($idTalla){

            }

            if ($stmtTallas->execute()) {
                $stmtTallas->close();
                $retorno = true;
            } else {
                echo "Error al actualizar o insertar en la tabla producto_talla.";
            }

            $stmtVerificar->close();
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