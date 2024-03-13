<?php
function verificarAutenticacion()
{
    session_start();
    if (!isset($_SESSION['login']) || !$_SESSION['login']) {

        header('Location: /login.php');
        exit();
    }
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "1") {

        header('Location: /index.php');
        exit();
    }
}
