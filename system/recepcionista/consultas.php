<?php include_once'header.php' ?>
<?php
include_once '../../php/classDentistaConsultaPaciente.php';
$dcp = new Dentista_consulta_Paciente();

if(isset($_POST['botao-remover'])){

$id = $_POST['id'];

$dcp->setId($id);
$dcp->delete();

}

?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div>
              <button class="btn btn-primary btn-block" onclick="window.location.href='cadastrar/cadastrar-consulta.php'" name="cadastrar-consulta">Cadastrar Consulta</button>
            </div>

            <div class="card-header">
              <i class="fas fa-table"></i>
              Consultas</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>Operação</th>
                      <th>Paciente</th>
                      <th>Dentista</th>
                      <th>Data</th>
                      <th>Hora</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Operação</th>
                      <th>Paciente</th>
                      <th>Dentista</th>
                      <th>Data</th>
                      <th>Hora</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php 

                      $stmt = $dcp->viewAll();

                      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                      <tr align="center">
                        <td> <?= $row->operacao; ?> </td>
                        <?php
                          $dcp->setId($row->id);
                          $nome_paciente = $dcp->nomePaciente();
                        ?>
                        <td> <?= $nome_paciente; ?> </td>
                        <?php
                          $nome_dentista = $dcp->nomeDentista();
                        ?>
                        <td> <?= $nome_dentista; ?> </td>
                        <td> <?= $row->data ?> </td>
                        <td> <?= $row->horario; ?> </td>
                        <td> <?= $row->valor; ?> </td>
                        <td> <?= $row->situacao; ?> </td>
                        <td><a href="editar/editar-consulta.php?id=<?=$row->id?>" class="btn btn-primary">Alterar</a></td>
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
      $stmt = $dcp->viewAll();

      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
      <div class="modal fade" id="removeModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Você tem certeza que deseja remover a consulta ?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Essa ação não poderá ser desfeita</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <form action="consultas.php" method="post">
                <input type="hidden" name="id" value="<?=$row->id?>">
                <button class="btn btn-primary" href="#" name="botao-remover">Remover</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php } include_once'footer.php' ?>
