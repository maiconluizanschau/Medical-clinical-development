<?php include_once'header.php' ?>
<?php
include_once '../../php/classAuxiliarAuxiliaDentista.php';

$aad = new Auxiliar_auxilia_Dentista();

if(isset($_POST['botao-remover'])){

  $dentista_id = $_POST['dentista_id'];
  $auxiliar_id= $_POST['auxiliar_id'];

  $aad->setDentistaId($dentista_id);
  $aad->setAuxiliarId($auxiliar_id);
  $aad->delete();
}

?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div>
              <button class="btn btn-primary btn-block" onclick="window.location.href='cadastrar/cadastrar-auxilio.php'" name="cadastrar-recebimento">Cadastrar Auxílio</button>
            </div>

            <div class="card-header">
              <i class="fas fa-table"></i>
              Auxílios</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>Dentista</th>
                      <th>Auxiliar</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Dentista</th>
                      <th>Auxiliar</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php 

                      $stmt = $aad->viewAll();

                      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                      <tr align="center">
                        <?php
                          $dentista_nome = $aad->nomeDentista($row->dentista_id, $row->auxiliar_id);
                        ?>
                        <td> <?= $dentista_nome; ?> </td>
                        <?php
                          $auxiliar_nome = $aad->nomeAuxiliar($row->dentista_id, $row->auxiliar_id);
                        ?>
                        <td> <?= $auxiliar_nome; ?> </td>
                        <td><a href="editar/editar-auxilio.php?dentista_id=<?=$row->dentista_id?>&auxiliar_id=<?=$row->auxiliar_id?>" class="btn btn-primary">Alterar</a></td>
                        <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->dentista_id?>-<?=$row->auxiliar_id?>">Remover</a></td>
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
<?php 

      $stmt = $aad->viewAll();

      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
      <div class="modal fade" id="removeModal<?=$row->dentista_id?>-<?=$row->auxiliar_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Você tem certeza que deseja remover esse auxílio?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Essa ação não poderá ser desfeita</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <form action="auxilios.php" method="post">
              <input type="hidden" name="dentista_id" value="<?=$row->dentista_id?>">
              <input type="hidden" name="auxiliar_id" value="<?=$row->auxiliar_id?>">
              <button type="submit" class="btn btn-primary" name="botao-remover">Remover</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php } include_once'footer.php' ?>