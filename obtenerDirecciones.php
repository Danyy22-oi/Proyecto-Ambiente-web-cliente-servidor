<?php
session_start();
    
require_once "include/functions/autenticado.php";
$auth = estaAutenticado();
if (!$auth) {
    header('Location: /');
}


    require "DAL/conexion.php";
    require_once "DAL/usuariosCrud.php";
    $db = conectarDb();
    header('Content-Type: application/json; charset=utf-8');

    $id = $_SESSION['id'];
    $query = "SELECT * FROM direccion WHERE id_usuario = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $direcciones = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $direcciones[] = $row;
    }

    echo json_encode($direcciones, JSON_UNESCAPED_UNICODE);



