<?php 
function conectarDb(){
    $server = 'localhost';
    $user = 'root';
    $password = '1234';
    $database = 'ZapateriaProyectoWeb';

    $conexion = mysqli_connect($server,$user,$password, $database);

    if(!$conexion){
        echo "Ocurrio un error al establecer la conexion";
    }

    return $conexion;
}

function  Desconectar($conexion){
    mysqli_close($conexion);
}
?>