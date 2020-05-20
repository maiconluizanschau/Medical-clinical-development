<?php
include_once'../../php/funcoesAuxiliares.php';
verificaFuncionarioLogado();
verificarRecepcionistaLogado();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clínica Odontológica</title>

    <!-- Bootstrap core CSS-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin.css" rel="stylesheet">
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="index.php">Clínica Odontológica</a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-users"></i>
            <span>Pacientes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="planos-dentarios.php">
            <i class="fas fa-id-card"></i>
            <span>Planos Dentários</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="consultas.php">
            <i class="fas fa-tooth"></i>
            <span>Consultas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="especialidades-dentistas.php">
            <i class="fas fa-screwdriver"></i>
            <span>Especialidades</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recebimentos.php">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Recebimentos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../index.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>