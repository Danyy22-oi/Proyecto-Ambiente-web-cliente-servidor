<?php
function estaAutenticado() : bool {
    session_start();

    $auth = $_SESSION['login'];
    if($auth) {
        return true;
    }
    return false;
}

function estaAutenticadoAdmin() : bool {
    session_start();
    $auth = $_SESSION['rol'];
    if($auth == 1) {
        return true;
    }
    return false;
}