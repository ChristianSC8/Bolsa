<?php

    include_once ("config.php");

    function conectar(){
        $link = new mysqli(HOST, USUARIO,PASSWORD, NOMBREBD);
        if ($link -> connect_errno) {
            die( "Error en la conexion.");
        }else{
            mysqli_query($link,"SET NAMES 'UTF8'");
            mysqli_set_charset($link, "utf8");
            date_default_timezone_set("America/Lima");
            return $link;
        }
    }
?>