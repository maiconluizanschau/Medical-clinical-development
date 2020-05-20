<?php include_once'header.php';
include_once '../../../php/classDentistaHasEspecialidade.php';
?>
  <body class="bg-dark">
    <div id="wrapper">
      <div id="content-wrapper">
        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div class="card-header">
              <i class="fas fa-table"></i>
              Pacientes</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>Dentista</th>
                      <th>Especialidade</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Dentista</th>
                      <th>Especialidade</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php 

                      $dhe = new Dentista_has_Especialidade();

                      $stmt = $dhe->viewAll();

                      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                      <tr align="center">
                        <?php
                          $dhe->setDentistaId($row->dentista_id);
                          $dentista_nome = $dhe->nomeDentista();
                        ?>
                        <td> <?= $dentista_nome; ?> </td>
                        <td> <?= $row->especialidade_nome; ?> </td>
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Bootstrap core JavaScript-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../../../js/demo/datatables-demo.js"></script>
    <script src="../../../js/demo/chart-area-demo.js"></script>

  </body>

</html>