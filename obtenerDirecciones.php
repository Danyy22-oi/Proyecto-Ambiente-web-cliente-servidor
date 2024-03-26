<?php



session_start();


require "DAL/conexion.php";
require_once "DAL/usuariosCrud.php";
$db = conectarDb();
header('Content-Type: application/json; charset=utf-8');

$id = ($_SESSION['id']);
$query = "SELECT * FROM direccion WHERE id_usuario = '$id'";
$resultado = mysqli_query($db, $query);

$arregloUsuario = array();
while ($usuarioinfo = mysqli_fetch_assoc($resultado)) {
   
    $arregloUsuario[] = $usuarioinfo;
}

 echo json_encode($arregloUsuario, JSON_UNESCAPED_UNICODE);





?>