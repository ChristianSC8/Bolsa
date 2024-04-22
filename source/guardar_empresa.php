<?php

    include("../includes/conectar.php");

    $conexion = conectar();



    //Recibimos datos del formulario
    $raso = $_POST['txt_razón_social'];
    $ruc = $_POST['txt_ruc'];
    $dir = $_POST['txt_direccion'];
    $telefono = $_POST['txt_teléfono'];
    $correo = $_POST['txt_correo'];
    $user = $_POST['user_id'] ?? null;
    

    /*
    echo "DNI recibido: ".$dni;
    echo "nombres recibido: ".$nombres;
    echo "apellidos recibido: ".$apellidos;
    echo "direccion recibido: ".$direccion;
    echo "telefono recibido: ".$telefono;
    */
    //conexion a la DB
    //gurdamos datos en tabla usuarios

    $sql = "INSERT INTO empresa (razón_social,ruc,dirección,teléfono, correo, id_usuario) VALUES('$raso','$ruc','$dir','$telefono','$correo','$user') ";

    mysqli_query($conexion,$sql) or die("Error al guardar.");
    
    header("location: listar_empresa.php");

?>