<?php
include "DAL/conexion.php";
include "include/functions/recoge.php";

$conexion = conectarDb();


if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}


$id = recogePost('id');
$nombre = recogePost('nombre');
$apellido = recogePost('apellido');
$correo = recogePost('correo');
$telefono = recogePost('telefono');
$newPassword = recogePost('newPassword');

if (!empty($newPassword)) {
    $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);

    $stmt = mysqli_prepare($conexion, "UPDATE usuario SET nombre=?, apellido=?, correo=?, telefono=? , contrasena = ? WHERE id_usuario=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $apellido, $correo, $telefono, $passwordHash, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Datos actualizados correctamente";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conexion);
    }


    mysqli_stmt_close($stmt);


    Desconectar($conexion);
} else {
    $stmt = mysqli_prepare($conexion, "UPDATE usuario SET nombre=?, apellido=?, correo=?, telefono=? WHERE id_usuario=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $correo, $telefono, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Datos actualizados correctamente";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conexion);
    }


    mysqli_stmt_close($stmt);


    Desconectar($conexion);
}
