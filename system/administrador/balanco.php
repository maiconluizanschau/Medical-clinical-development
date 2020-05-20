<?php 
include_once'header.php';
include_once'../../php/classBalanco.php';

$b = new Balanco();

?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div class="card-header">
              <i class="fas fa-table"></i>
              Balanço</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>Valor das Despesas</th>
                      <th>Valor dos Recebimentos</th>
                      <th>Saldo</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Valor das Despesas</th>
                      <th>Valor dos Recebimentos</th>
                      <th>Saldo</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <tr align="center">
                        <?php 
                          $despesas = number_format($b->valorDespesas(),2);
                          $recebimentos = number_format($b->valorRecebimentos(),2);
                          $saldo = number_format($b->mostraSaldo(),2);
                         ?>
                        <td> <?= $despesas ?> </td>
                        <td> <?= $recebimentos ?> </td>
                        <td> <?= $saldo ?> </td>
                      </tr>
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
