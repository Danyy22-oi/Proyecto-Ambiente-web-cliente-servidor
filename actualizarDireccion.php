<?php

include 'DAL/conexion.php';
include 'include/functions/recoge.php';


$conexion = conectarDb();

if (!$conexion) {
    die("Error al conectar a la base de datos:" . mysqli_connect_error());
}

$id = recogePost('id');
$direccion = recogePost('direccion');
$direccion2 = recogePost('direccion2');

$stmt = mysqli_prepare($conexion, "UPDATE direccion set direccion_1 = ?, direccio_2 = ? where id_direccion = ?");
mysqli_stmt_bind_param($stmt, "ssi", $direccion, $direccion2, $id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Datos actualizados correctamente";
} else {
    echo "Error al actualizar los datos: " . mysqli_error($conexion);
}


mysqli_stmt_close($stmt);


Desconectar($conexion);
