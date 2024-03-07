<?php
function estaAutenticado(): bool
{
    session_start();
    if ($_SESSION['login']) {
        return true;
    }

    return false;
}
