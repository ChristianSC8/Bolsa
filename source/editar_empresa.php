<?php
include("../includes/conectar.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recuperar información del usuario de la base de datos según el ID
    $conexion = conectar();
    $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
    $sql = "SELECT * FROM empresa WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
    } else {
        echo "Empresa no encontrado.";
        exit();
    }
} else {
    echo "ID de empresa no especificado.";
    exit();
}

// Más adelante en el mismo archivo, puedes utilizar la información de $usuario para mostrar un formulario de edición.
?>


<?php
include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div style=" width: 100%;
  padding: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;">


    <!-- Inicio Zona  central del sistema  -->

    <h1 class="mt-5">Editar Empresa</h1>
    <form class="row g-3" method="POST" action="actualizar_empresa.php">
        <input type="hidden" name="id" value="<?php echo ($usuario['id']) ?>">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Razon Social</label>
            <input type="text" name="txt_razón_social" class="form-control" value="<?php echo ($usuario['razón_social']) ?>">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Ruc</label>
            <input type="number" name="txt_ruc" class="form-control" value="<?php echo ($usuario['ruc']) ?>">
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Dirección</label>
            <input type="text" name="txt_direccion" class="form-control" id="inputAddress" value="<?php echo ($usuario['dirección']) ?>">
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Teléfono</label>
            <input type="number" name="txt_teléfono" class="form-control" id="inputAddress2" value="<?php echo ($usuario['teléfono']) ?>">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label"> Correo</label>
            <input type="text" name="txt_correo" class="form-control" id="inputCity" value="<?php echo ($usuario['correo']) ?>">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label"> Usuario a cargo</label>
            <select name="user_id" id="usuarios" class="form-control">
                <?php
                $idu = $usuario['id_usuario'];
                $conexion = conectar();
                $sql = "SELECT * FROM usuarios";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $selected = ($fila['id'] == $idu) ? 'selected' : '';
                    echo '<option value="' . $fila['id'] . '" ' . $selected . '>' . $fila['nombre'] . ' ' . $fila['apellidos'] . '</option>';
                }
                ?>
            </select>

        </div>

        <div class="col-md-12">
            <label for="inputZip" class="form-label"></label>
        </div>

        <div class="col-12 ">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>







    <!-- Fin Zona  central del sistema  -->


</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- /.container-fluid -->
<?php
include("../includes/foot.php");
?>