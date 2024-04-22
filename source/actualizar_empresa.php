<?php
include("../includes/conectar.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió un ID válido
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        // Recuperar los datos del formulario
        $nombres = $_POST['txt_razón_social'];
        $apellidos = $_POST['txt_ruc'];
        $dni = $_POST['txt_direccion'];
        $telefono = $_POST['txt_teléfono'];
        $direccion = $_POST['txt_correo'];
        $user = $_POST['user_id'];

        // Actualizar los datos del usuario en la base de datos
        $conexion = conectar();
        $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
        $dni = mysqli_real_escape_string($conexion, $dni);
        $nombres = mysqli_real_escape_string($conexion, $nombres);
        $apellidos = mysqli_real_escape_string($conexion, $apellidos);
        $direccion = mysqli_real_escape_string($conexion, $direccion);
        $telefono = mysqli_real_escape_string($conexion, $telefono);
        
        $sql = "UPDATE empresa SET dirección='$dni', razón_social='$nombres', ruc='$apellidos', correo='$direccion', teléfono='$telefono', id_usuario='$user' WHERE id=$id";

        if (mysqli_query($conexion, $sql)) {
            echo "Empresa actualizado correctamente.";
        } else {
            echo "Error al Empresa usuario: " . mysqli_error($conexion);
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    } else {
        echo "ID de empresa no válido.";
    }
} else {
    echo "Solicitud no válida.";
}



header("location: listar_empresa.php");
?>
