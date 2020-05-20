<?php include_once'header.php' ?>
<?php
include_once '../../php/classDentistaHasEspecialidade.php';

if(isset($_POST['botao-remover'])){
  $dhe = new Dentista_has_Especialidade();

  $dentista_id = $_POST['dentista_id'];
  $especialidade_nome = $_POST['especialidade_nome'];

  $dhe->setEspecialidadeNome($especialidade_nome);
  $dhe->setDentistaId($dentista_id);
  $dhe->delete();
}
?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div>
              <button class="btn btn-primary btn-block" onclick="window.location.href='cadastrar/cadastrar-especialidade-dentista.php'" name="cadastrar-especialidade-dentista">Cadastrar Especialidade para Dentista</button>
            </div>

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
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Dentista</th>
                      <th>Especialidade</th>
                      <th></th>
                      <th></th>
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
                        <td><a href="editar/editar-especialidade-dentista.php?dentista_id=<?=$row->dentista_id?>&especialidade_nome=<?=$row->especialidade_nome?>" class="btn btn-primary">Alterar</a></td>
                        <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->dentista_id?>-<?=$row->especialidade_nome?>">Remover</a></td>
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

      $stmt = $dhe->viewAll();

      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
      <div class="modal fade" id="removeModal<?=$row->dentista_id?>-<?=$row->especialidade_nome?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <?php
                $dhe->setDentistaId($row->dentista_id);
                $dentista_nome = $dhe->nomeDentista();
              ?>
              <h5 class="modal-title" id="exampleModalLabel">Você tem certeza que deseja remover a especialidade <?=$row->especialidade_nome?> do dentista <?=$dentista_nome?> ?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Essa ação não poderá ser desfeita</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <form action="especialidades-dentistas.php" method="post">
              <input type="hidden" name="dentista_id" value="<?=$row->dentista_id?>">
              <input type="hidden" name="especialidade_nome" value="<?=$row->especialidade_nome?>">
              <button type="submit" class="btn btn-primary" name="botao-remover">Remover</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php } include_once'footer.php' ?>
