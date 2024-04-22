<?php
include("../includes/conectar.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Recuperar información del usuario de la base de datos según el ID
    $conexion = conectar();
    $id = mysqli_real_escape_string($conexion, $id); // Evita inyección SQL
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    echo "ID de usuario no especificado.";
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

    <h1 class="mt-5">Editar Usuario</h1>
    <form style=" width: 650px;" method="POST" action="actualizar_usuario.php" style=" width: 650px;">
    <input type="hidden" name="id" value="<?php echo ($usuario['id'])?>">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nombre</label>
            <input type="text" name="txt_nombres" class="form-control" placeholder="Juna" value="<?php echo ($usuario['nombre'])?>">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Apellidos</label>
            <input type="text" name="txt_apellidos" class="form-control" placeholder="perez"value="<?php echo ($usuario['apellidos'])?>" >
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">DNI</label>
            <input type="number" name="txt_dni" class="form-control" id="inputAddress" value="<?php echo ($usuario['dni'])?>">
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Telefono</label>
            <input type="number" name="txt_teléfono" class="form-control" id="inputAddress2"  value="<?php echo ($usuario['teléfono'])?>">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label"> Dirección</label>
            <input type="text" name="txt_dirección" class="form-control" id="inputCity" value="<?php echo ($usuario['dirección'])?>">
        </div>
        <div class="col-md-6">
            <label for="inputZip" class="form-label">Usuario</label>
            <input type="text" name="txt_usuario" class="form-control" id="inputZip" value="<?php echo ($usuario['usuario'])?>" >
        </div>

        <div class="col-md-12">
            <label for="inputZip" class="form-label">Contraseña</label>
            <input type="text" name="txt_contraseña" class="form-control" id="inputZip" value="<?php echo ($usuario['contrasena'])?>">
        </div>


        <div class="col-12 ">
            <button type="submit" class="btn btn-primary" style="  margin-top: 20px;width: 580px;">Editar</button>
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