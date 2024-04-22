<link href="themplates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<?php
include("../includes/head.php");
include("../includes/conectar.php");
?>

<!-- Begin Page Content -->
<div style=" width: 100%;
  padding: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;">

    <h1>Registro Nueva Empresa </h1>
    <!-- Inicio Zona  central del sistema  -->


    <form class="" method="POST" action="guardar_empresa.php" style=" width: 650px;">
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Razon Social</label>
            <input type="text" name="txt_razón_social" class="form-control">
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Ruc</label>
            <input type="number" name="txt_ruc" class="form-control">
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Dirección</label>
            <input type="text" name="txt_direccion" class="form-control" id="inputAddress">
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Teléfono</label>
            <input type="number" name="txt_teléfono" class="form-control" id="inputAddress2">
        </div>
        <div class="col-md-12">
            <label for="inputCity" class="form-label"> Correo</label>
            <input type="text" name="txt_correo" class="form-control" id="inputCity">
        </div>
        <div class="col-md-12">
            <label for="inputCity" class="form-label"> Usuario a cargo</label>
            <select name="user_id" id="usuarios" class="form-control">
                <option value="0">Usuarios</option>
                <?php
                $conexion = conectar();
                $sql = "SELECT * FROM usuarios WHERE asignado=0 OR asignado IS NULL";
                $resultado = mysqli_query($conexion, $sql);

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    // Imprime una opción por cada fila de la consulta
                    echo '<option  value="' . $fila['id'] . '">' . $fila['nombre'] . ' ' . $fila['apellidos'] . '</option>';
                }

                // // Cerrar conexión y liberar recursos
                // mysqli_close($conexion);
                ?>
            </select>

        </div>


        <div class="col-md-12">
            <label for="inputZip" class="form-label"></label>
        </div>

        <div class="col-12 ">
            <button type="submit" class="btn btn-primary" style=" width: 600px;">Guardar</button>
        </div>
    </form>





    <!-- Fin Zona  central del sistema  -->


</div>
<!-- /.container-fluid -->
<?php
include("../includes/foot.php");
?>