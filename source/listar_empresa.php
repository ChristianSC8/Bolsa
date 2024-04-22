<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Lista de empresas</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Empresas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Razón Social</th>
                            <th>RUC</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Usuario a cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $goku = "SELECT * FROM empresa";
                        $lista = mysqli_query($conexion, $goku);

                        while ($fila = mysqli_fetch_array($lista)) {
                            $id_usuario = $fila['id_usuario'];

                            $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";
                            $resultado = mysqli_query($conexion, $sql);
                            $usuario = mysqli_fetch_assoc($resultado);

                            echo "<tr>";
                            echo "<td>" . $fila["razón_social"] . "</td>";
                            echo "<td>" . $fila["ruc"] . "</td>";
                            echo "<td>" . $fila["dirección"] . "</td>";
                            echo "<td>" . $fila["teléfono"] . "</td>";
                            echo "<td>" . $fila["correo"] . "</td>";

                            if ($usuario) {
                                echo "<td style='color: blue    ;'>" . $usuario["nombre"] . "</td>";
                            } else {
                                echo "<td style='color: red;'>Sin asignar</td>";
                            }

                            echo "<td>";
                            ?>
                            <button class="btn btn-primary" onclick="editar_sayayin('<?php echo $fila['id'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" onclick="delete_sayayin('<?php echo $fila['id'] ?>', '<?php echo $fila['id_usuario'] ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                            <?php if ($fila['id_usuario'] == 0 || $fila['id_usuario'] == null) { ?>
                                <button class="btn bg-gradient-success" style="color: white;background:#59DE40" onclick="f_mostraruser(<?php echo $fila['id']; ?>)">
                                    Asignar
                                </button>
                            <?php } ?>
                            <?php echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/foot.php"); ?>

<div id="div_usuarios" style="display: none;">
    <div>
        <h2 style="font-weight: bold; text-align: center; margin-bottom: 20px;">Lista de Usuarios sin Empresas Asignadas</h2>
        <?php
        $sql_usuarios = "SELECT * FROM usuarios WHERE asignado = 0 OR asignado IS NULL";
        $registro_usuarios = mysqli_query($conexion, $sql_usuarios);
        while ($fila_user = mysqli_fetch_array($registro_usuarios)) {
            echo '<a style="display: block; cursor: pointer; color: #B4BEC9; text-decoration: none; margin-bottom: 15px; padding: 10px; border-radius: 8px;" onclick="f_asignar(' . $fila_user["id"] . ')" onmouseover="this.style.backgroundColor=\'#4CAF50\'; this.style.color=\'white\';" onmouseout="this.style.backgroundColor=\'#fff\'; this.style.color=\'#B4BEC9\';">';
            echo $fila_user["nombre"] . " " . $fila_user["apellidos"] . "<br>";
            echo '</a>';
        }
        ?>
    </div>
</div>

<script>
    var EMPRESA_ID;
    $(document).ready(function() {
        $("#div_usuarios").dialog({
            autoOpen: false,
            width: 800,
            height: 700,
            modal: true, // Hace que el modal sea modal (bloquea el fondo)
            buttons: { // Botones por defecto del modal
                "Cerrar": function() {
                    $(this).dialog("close");
                }
            },
            // Estilos para el modal
        });
    });

    function f_mostraruser(id) {
        EMPRESA_ID = id;
        $("#div_usuarios").dialog("open");
    }

    function editar_sayayin(id) {
        location.href = "editar_empresa.php?id=" + id;
    }

    function f_asignar(id) {
        location.href = "asignarempresa.php?id=" + id + "&ide=" + EMPRESA_ID;
    }

    function delete_sayayin(id, ideu) {
        location.href = "eliminar_empresa.php?id=" + id + "&ideu=" + ideu;
    }
</script>
