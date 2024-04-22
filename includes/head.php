<?php
include("config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de bolsa laboral</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo RUTAGENERAL; ?>themplates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo RUTAGENERAL; ?>css/sb-admin-2.min.css" rel="stylesheet">
    <script src="<?php echo RUTAGENERAL; ?>js/jquery-ui.min.js"></script>
    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="<?php echo RUTAGENERAL; ?>js/jquery-ui.theme.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Inicio Sidebar - menu izquierdo -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="<?php echo RUTAGENERAL; ?>themplates/img/portafolio.png" alt="" width="30px" style="margin-right: 5px;">
                </div>
                <div class="sidebar-brand-text mx-1">Bolsa Laboral</div>
            </a>
            <!-- Nav Item - Inicio -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo RUTAGENERAL; ?>index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/registro_usuarios.php">Registrar usuario</a>
                        <?php
                        if (isset($_SESSION['S_ROL']) == 1) {
                        ?>
                            <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/listar_usuarios.php">Lista de Usuarios</a>
                        <?php

                        }
                        ?>
                        <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a> -->
                    </div>
                </div>
            </li>
            <?php
            if (isset($_SESSION['S_ROL']) == 1) {
            ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-building"></i>
                        <span>Empresas</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <?php
                            if (isset($_SESSION['S_ROL']) == 1) {
                            ?>
                                <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/registrar_empresa.php">Registrar Empresa</a>
                                <a class="collapse-item" href="<?php echo RUTAGENERAL; ?>source/listar_empresa.php">Listar Empresas</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </li>
            <?php

            }
            ?>
           
          
            <!-- Nav Item - Charts -->
            <?php
            if (!isset($_SESSION['S_ROL'])) {
            ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/form_login.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Iniciar Sección</span></a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTAGENERAL; ?>source/logout.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Cerrar Sección</span></a>
                </li>
            <?php
            }
            ?>
        </ul>
        <!-- Fin Sidebar - menu izquierdo -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php

                    if (isset($_SESSION['S_NOM'])) {
                        echo "Bienvenido " . $_SESSION['S_NOM'] . " " . $_SESSION['S_APE'];
                    } else {
                        echo "Iniciar Sección";
                    }
                    ?>
                </nav>
                <!-- End of Topbar -->