<?php

function recogePost($var , $m = ""){
    //isset devolverá FALSE cuando verifique una variable que se haya asignado a NULL
    if(!isset($_POST[$var])){
     //is_array Encuentra si una variable esta en una matriz.
     $tmp = (is_array($m))? []: ""; 

    }elseif (!is_array($_POST[$var])){
      //trim recorta caracteres desde el principio y el final de una cadena
    //htmlspecialchars Convierta caracteres especiales en entidades HTML
    // ENT_COMPAT: predeterminado. Codifica solo comillas dobles
    // ENT_QUOTES - Codifica comillas dobles y simples
    // ENT_NOQUOTES: no codifica ninguna cita 
    $tmp = trim(htmlspecialchars($_POST[$var], ENT_QUOTES, "UTF-8" )); 
    }else{
         // La función array_walk_recursive () ejecuta cada elemento de la matriz en una función 
    //definida por el usuario. Las claves y los valores de la matriz son parámetros en la función. 
    //La diferencia entre esta función y la función array_walk () es que con esta función puede trabajar 
    //con matrices más profundas (una matriz dentro de una matriz).
    /* <?php
    function myfunction($value,$key)
    {
    echo "The key $key has the value $value<br>";
    }
    $a1=array("a"=>"red","b"=>"green");
    $a2=array($a1,"1"=>"blue","2"=>"yellow");
    array_walk_recursive($a2,"myfunction");
    ?> */
    array_walk_recursive($tmp, function (&$valor){
        $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
    });
    }
    return $tmp;
} 

function recogeGET($var , $m = ""){
    if(!isset($_GET[$var])){
        $tmp = (is_array($m))? [] : "";
    } elseif (!is_array($_GET[$var])) {
        $tmp = trim(htmlspecialchars($_GET[$var], ENT_QUOTES, "UTF-8"));
    }else{
        $tmp = $_GET[$var];
            array_walk_recursive($tmp, function(&$valor){
                $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
            });
    }
    return $tmp;
}


?>