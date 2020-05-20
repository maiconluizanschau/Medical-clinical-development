<?php include_once'header.php' ?>
<?php
include_once '../../php/classEspecialidade.php';

if(isset($_POST["botao-remover"])){

  $nome = $_POST["nome"];

  include_once "../../php/classEspecialidade.php";
  $e = new Especialidade();
  $e->setNome($nome);
  $e->delete();
}

?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div>
              <button class="btn btn-primary btn-block" onclick="window.location.href='cadastrar/cadastrar-especialidade.php'" name="especialidade">Cadastrar Especialidade</button>
            </div>

            <div class="card-header">
              <i class="fas fa-table"></i>
              Especialidades</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>Nome</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Nome</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php 
                      $e = new Especialidade();
                      $stmt = $e->viewAll();

                      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                      <tr align="center">
                        <td> <?= $row->nome; ?> </td>
                        <td><a href="editar/editar-especialidade?nome=<?=$row->nome?>" class="btn btn-primary">Alterar</a></td>
                        <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->nome?>">Remover</a></td>
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

      $stmt = $e->viewAll();

      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
      <div class="modal fade" id="removeModal<?=$row->nome?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Você tem certeza que deseja remover a especialidade <?= $row->nome ?>?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Essa ação não poderá ser desfeita</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <form action="especialidades.php" method="post">
              <input type="hidden" name="nome" value="<?= $row->nome ?>">
              <button class="btn btn-primary" name="botao-remover">Remover</button>
            </form>
            </div>
          </div>
        </div>
      </div>
<?php } include_once'footer.php' ?>
