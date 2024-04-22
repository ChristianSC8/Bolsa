<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Lista de usuarios</h1>
    <!-- Botones para cambiar entre tabla y cuadros -->
    <div class="mb-3">
        <button class="btn btn-primary" id="switchToTable"><i class="fas fa-table"></i> Ver en tabla</button>
        <button class="btn btn-primary" id="switchToCards"><i class="fas fa-th-large"></i> Ver en tarjetas</button>
    </div>
    
    <!-- Contenedor de lista de usuarios -->
    <div id="userListContainer"></div>

</div>
<!-- /.container-fluid -->

<?php
include("../includes/foot.php");
?>

<script>
    // Función para cargar la lista de usuarios en forma de tabla
    function loadUserTable() {
        var userListContainer = document.getElementById("userListContainer");
        userListContainer.innerHTML = `
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios (Tabla)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>DNI</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Usuario</th>
                                    <th>Empresa</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $goku = "SELECT * FROM usuarios";
                                $lista = mysqli_query($conexion, $goku);
                                // Verificar si la consulta tuvo éxito
                                if ($lista) {
                                    while ($fila = mysqli_fetch_array($lista)) {
                                        $id_empresa = $fila['asignado'];
                                        // Utilizar consultas preparadas para prevenir la inyección SQL
                                        $sql = "SELECT * FROM empresa WHERE id = ?";
                                        $stmt = mysqli_prepare($conexion, $sql);
                                        mysqli_stmt_bind_param($stmt, "i", $id_empresa);
                                        mysqli_stmt_execute($stmt);
                                        $resultado = mysqli_stmt_get_result($stmt);
                                        // Verificar si se encontró una empresa
                                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                                            $usuario = mysqli_fetch_assoc($resultado);
                                            $nombre_empresa = $usuario["razón_social"];
                                        } else {
                                            $nombre_empresa = "sin asignar";
                                        }
                                ?>
                                        <tr>
                                            <td><?php echo $fila["nombre"]; ?></td>
                                            <td><?php echo $fila["apellidos"]; ?></td>
                                            <td><?php echo $fila["dni"]; ?></td>
                                            <td><?php echo $fila["dirección"]; ?></td>
                                            <td><?php echo $fila["teléfono"]; ?></td>
                                            <td><?php echo $fila["usuario"]; ?></td>
                                            <td><?php echo $nombre_empresa; ?></td>
                                            <td>
                                                <button class="btn btn-primary" onclick="editar_sayayin(<?php echo $fila['id']; ?>)"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger" onclick="delete_sayayin(<?php echo $fila['id']; ?>)"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // Mostrar un mensaje de error si la consulta falla
                                    echo "<tr><td colspan='8'>Error al obtener los usuarios.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;
    }

    // Función para cargar la lista de usuarios en forma de tarjetas
    function loadUserCards() {
        var userListContainer = document.getElementById("userListContainer");
        userListContainer.innerHTML = `
            <div class="row">
                <?php
                $goku = "SELECT * FROM usuarios";
                $lista = mysqli_query($conexion, $goku);
                // Verificar si la consulta tuvo éxito
                if ($lista) {
                    while ($fila = mysqli_fetch_array($lista)) {
                        $id_empresa = $fila['asignado'];
                        // Utilizar consultas preparadas para prevenir la inyección SQL
                        $sql = "SELECT * FROM empresa WHERE id = ?";
                        $stmt = mysqli_prepare($conexion, $sql);
                        mysqli_stmt_bind_param($stmt, "i", $id_empresa);
                        mysqli_stmt_execute($stmt);
                        $resultado = mysqli_stmt_get_result($stmt);
                        // Verificar si se encontró una empresa
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            $usuario = mysqli_fetch_assoc($resultado);
                            $nombre_empresa = "<span style='color: purple;'>" . $usuario["razón_social"] . "</span>";
                        } else {
                            $nombre_empresa = "<span style='color: purple;'>No disponible</span>";
                        }
                ?>
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $fila["nombre"] . " " . $fila["apellidos"]; ?></h5>
                                    <p class="card-text"><strong>DNI:</strong> <?php echo $fila["dni"]; ?></p>
                                    <p class="card-text"><strong>Dirección:</strong> <?php echo $fila["dirección"]; ?></p>
                                    <p class="card-text"><strong>Teléfono:</strong> <?php echo $fila["teléfono"]; ?></p>
                                    <p class="card-text"><strong>Usuario:</strong> <?php echo $fila["usuario"]; ?></p>
                                    <p class="card-text"><strong>Empresa:</strong> <?php echo $nombre_empresa; ?></p>
                                    <button class="btn btn-primary" onclick="editar_sayayin(<?php echo $fila['id']; ?>)"><i class="fas fa-edit"></i> Editar</button>
                                    <button class="btn btn-danger" onclick="delete_sayayin(<?php echo $fila['id']; ?>)"><i class="fas fa-trash"></i> Eliminar</button>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    // Mostrar un mensaje de error si la consulta falla
                    echo "<div class='col-12'><p class='text-danger'>Error al obtener los usuarios.</p></div>";
                }
                ?>
            </div>
        `;
    }

    // Cargar la lista de usuarios por defecto en forma de tabla al cargar la página
    loadUserTable();

    // Función para cambiar a la vista de tabla
    document.getElementById("switchToTable").addEventListener("click", function() {
        var switchToTableButton = document.getElementById("switchToTable");
        var switchToCardsButton = document.getElementById("switchToCards");

        switchToTableButton.classList.remove("btn-outline-primary");
        switchToTableButton.classList.add("btn-primary");
        switchToCardsButton.classList.remove("btn-primary");
        switchToCardsButton.classList.add("btn-outline-primary");

        loadUserTable();
    });

    // Función para cambiar a la vista de tarjetas
    document.getElementById("switchToCards").addEventListener("click", function() {
        var switchToTableButton = document.getElementById("switchToTable");
        var switchToCardsButton = document.getElementById("switchToCards");

        switchToTableButton.classList.remove("btn-primary");
        switchToTableButton.classList.add("btn-outline-primary");
        switchToCardsButton.classList.remove("btn-outline-primary");
        switchToCardsButton.classList.add("btn-primary");

        loadUserCards();
    });

    function editar_sayayin(id) {
        //redirect
        location.href = "editar_usuario.php?id=" + id;
    }

    function delete_sayayin(id) {
        if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
            location.href = "eliminar_usuario.php?id=" + id;
        }
    }
</script>
