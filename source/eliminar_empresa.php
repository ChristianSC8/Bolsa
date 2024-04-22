<?php
include("../includes/conectar.php");

if (isset($_GET['id']) && isset($_GET['ideu'])) {
    $id = $_GET['id'];
    $ideu = $_GET['ideu'];
    // Eliminar el usuario de la base de datos
    $conexion = conectar();
    $id = mysqli_real_escape_string($conexion, $id);
    $ideu = mysqli_real_escape_string($conexion, $ideu);
    // Construir las consultas
    $sql = "DELETE FROM empresa WHERE id = $id; ";
    $sql .= "UPDATE usuarios SET asignado='0' WHERE id = $ideu";

    $resultado = mysqli_multi_query($conexion, $sql);

    if ($resultado) {
        echo "Empresa eliminado correctamente.";
    } else {
        echo "Error al eliminar empresa.";
    }
} else {
    echo "ID de empresa no especificado.";
    exit();
}
header("location: listar_empresa.php");
