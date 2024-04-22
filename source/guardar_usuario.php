<?php

    include("../includes/conectar.php");

    $conexion = conectar();



    //Recibimos datos del formulario
    $nombres = $_POST['txt_nombres'];
    $apellidos = $_POST['txt_apellidos'];
    $dni = $_POST['txt_dni'];
    $telefono = $_POST['txt_teléfono'];
    $direccion = $_POST['txt_dirección'];
    $usuario = $_POST['txt_usuario'];
    $contraseña = $_POST['txt_contraseña'];

    /*
    echo "DNI recibido: ".$dni;
    echo "nombres recibido: ".$nombres;
    echo "apellidos recibido: ".$apellidos;
    echo "direccion recibido: ".$direccion;
    echo "telefono recibido: ".$telefono;
    */
    //conexion a la DB
    //gurdamos datos en tabla usuarios

    $sql = "INSERT INTO usuarios (dni,nombre,apellidos,dirección,teléfono, usuario, contrasena, id_rol) VALUES('$dni','$nombres','$apellidos','$direccion','$telefono', '$usuario', '$contraseña' , '1') ";

    mysqli_query($conexion,$sql) or die("Error al guardar.");
    
    header("location: listar_usuarios.php");

?>