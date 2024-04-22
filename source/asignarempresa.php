<?php
include("../includes/conectar.php");

if (isset($_GET['id']) && isset($_GET['ide'])) {
    $conn = conectar();
    $idu = $_GET['id'];
    $ide = $_GET['ide'];
    $sql = "UPDATE usuarios u, empresa e 
    SET e.id_usuario='$idu', u.asignado='$ide' WHERE u.id = '$idu' AND e.id = '$ide'";
    if (mysqli_query($conn, $sql)) {
        echo "Usuario asignaod correctamente.";
        header("location: listar_empresa.php");
    } else {
        echo "Error al asignar usuario: " . mysqli_error($conexion);
    }
} else {
    echo "Error";
}

?>
