<?php include_once'header.php' ?>
<?php
include_once '../../php/classDespesa.php';
$d = new Despesa();

if(isset($_POST['botao-remover'])){

$id = $_POST['id'];

$d->setId($id);
$d->delete();

}
?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div>
              <button class="btn btn-primary btn-block" onclick="window.location.href='cadastrar/cadastrar-despesa.php'" name="cadastrar-despesa">Cadastrar Despesa</button>
            </div>

            <div class="card-header">
              <i class="fas fa-table"></i>
              Despesas</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>Nome</th>
                      <th>Data</th>
                      <th>Valor</th>
                      <th>Tipo</th>
                      <th>Situação</th>
                      <th>Administrador</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Nome</th>
                      <th>Data</th>
                      <th>Valor</th>
                      <th>Tipo</th>
                      <th>Situação</th>
                      <th>Administrador</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php 

                      $stmt = $d->viewAll();

                      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                      <tr align="center">
                        <td> <?= $row->nome; ?> </td>
                        <td> <?= $row->data; ?> </td>
                        <td> <?= $row->valor; ?> </td>
                        <td> <?= $row->tipo; ?> </td>
                        <td> <?= $row->situacao; ?> </td>
                        <?php
                          $d->setId($row->id);
                          $administrador = $d->nomeAdministrador();
                        ?>
                        <td> <?=  $administrador; ?> </td>
                        <td><a href="editar/editar-despesa.php?id=<?=$row->id?>" class="btn btn-primary">Alterar</a></td>
                        <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->id?>">Remover</a></td>
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

      $stmt = $d->viewAll();

      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
      <div class="modal fade" id="removeModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Você tem certeza que deseja remover a despesa <?=$row->nome?>?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Essa ação não poderá ser desfeita</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <form action="despesas.php" method="post">
                <input type="hidden" name="id" value="<?=$row->id?>">
                <button class="btn btn-primary" href="#" name="botao-remover">Remover</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php } include_once'footer.php' ?>
