<?php include_once'header.php' ?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div class="card-header">
              <i class="fas fa-table"></i>
              Especialidades por Dentista</div>

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
                      include_once '/../../php/classDentistaHasEspecialidade.php';

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
<?php include_once'footer.php' ?>
