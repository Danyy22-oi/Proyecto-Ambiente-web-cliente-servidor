<?php
include 'include/functions/autenticado.php';
$auth = estaAutenticado();
if (!$auth) {
    header('Location: /login.php');
}
