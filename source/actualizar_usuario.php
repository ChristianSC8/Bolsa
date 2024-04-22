<?php
include("../includes/conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió un ID válido
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        // Recuperar los datos del formulario
        $nombres = $_POST['txt_nombres'];
        $apellidos = $_POST['txt_apellidos'];
        $dni = $_POST['txt_dni'];
        $telefono = $_POST['txt_teléfono'];
        $direccion = $_POST['txt_dirección'];
        $usuario = $_POST['txt_usuario'];
        $contraseña = $_POST['txt_contraseña'];   

        // Actualizar los datos del usuario en la base de datos
        $conexion = conectar();
        $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
        $dni = mysqli_real_escape_string($conexion, $dni);
        $nombres = mysqli_real_escape_string($conexion, $nombres);
        $apellidos = mysqli_real_escape_string($conexion, $apellidos);
        $direccion = mysqli_real_escape_string($conexion, $direccion);
        $telefono = mysqli_real_escape_string($conexion, $telefono);
        
        $sql = "UPDATE usuarios SET dni='$dni', nombre='$nombres', apellidos='$apellidos', dirección='$direccion', teléfono='$telefono' , usuario='$usuario' ,contrasena='$contraseña' WHERE id=$id";

        if (mysqli_query($conexion, $sql)) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error al actualizar usuario: " . mysqli_error($conexion);
        }

        // Cerrar la conexión
        mysqli_close($conexion);
    } else {
        echo "ID de usuario no válido.";
    }
} else {
    echo "Solicitud no válida.";
}

header("location: listar_usuarios.php");
?>
