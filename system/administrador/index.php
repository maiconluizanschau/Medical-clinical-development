<?php include_once'header.php' ?>
<?php

if(isset($_POST["botao-remover"])){

  $id = $_POST["id"];

  include_once "../../php/classFuncionario.php";
  $f = new Funcionario();
  $f->setId($id);
  $f->delete();

}
?>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">

            <div>
              <button class="btn btn-primary btn-block" onclick="window.location.href='cadastrar/cadastrar-funcionario.php'" name="cadastrar-funcionario">Cadastrar Funcionário</button>
            </div>

            <div class="card-header">
              <i class="fas fa-table"></i>
              Funcionários
              <div class="float-right">
                <form action="index.php" method="post">
                  <select name="cargo">
                    <option value="Administrador">Administrador</option>
                    <option value="Auxiliar">Auxiliar</option>
                    <option value="Dentista">Dentista</option>
                    <option value="Recepcionista">Recepcionista</option>
                  </select>
                  <button class="btn" name="btn">Buscar detalhes</button>
                </form>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $flag = 0; 
                if(isset($_POST["btn"])){
                  $cargo = $_POST["cargo"];
                  if($cargo == "Administrador"){ 
                  ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th>Nome de Usuário</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th>Nome de Usuário</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php 
                          include_once '../../php/classAdministrador.php';

                          $a = new Administrador();

                          $stmt = $a->viewAll();

                          while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                          <tr align="center">
                            <td> <?= $row->nome; ?> </td>
                            <td> <?= $row->sobrenome; ?> </td>
                            <td> <?= $row->nascimento; ?> </td>
                            <td> <?= empty($row->cpf)? "" : $row->cpf; ?> </td>
                            <td> <?= $row->salario; ?> </td>
                            <td> <?= $row->cargo; ?> </td>
                            <td> <?= $row->nome_usuario; ?></td>
                            <td><a href="editar/editar-funcionario.php?id=<?=$row->funcionario_id?>" class="btn btn-primary">Alterar</a></td>
                            <?php $id = $row->funcionario_id; ?>
                            <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->id?>">Remover</a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                <?php 
                  } elseif($cargo == "Recepcionista"){ 
                ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th>Nome de Usuário</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th>Nome de Usuário</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php 
                          include_once '../../php/classRecepcionista.php';

                          $r = new Recepcionista();

                          $stmt = $r->viewAll();

                          while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                          <tr align="center">
                            <td> <?= $row->nome; ?> </td>
                            <td> <?= $row->sobrenome; ?> </td>
                            <td> <?= $row->nascimento; ?> </td>
                            <td> <?= empty($row->cpf)? "" : $row->cpf; ?> </td>
                            <td> <?= $row->salario; ?> </td>
                            <td> <?= $row->cargo; ?> </td>
                            <td> <?= $row->nome_usuario; ?></td>
                            <td><a href="editar/editar-funcionario.php?id=<?=$row->funcionario_id?>" class="btn btn-primary">Alterar</a></td>
                            <?php $id = $row->funcionario_id; ?>
                            <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->id?>">Remover</a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                <?php 
                  } elseif($cargo == "Dentista"){ 
                ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th>CRO</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th>CRO</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php 
                          include_once '../../php/classDentista.php';

                          $d = new Dentista();

                          $stmt = $d->viewAll();

                          while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                          <tr align="center">
                            <td> <?= $row->nome; ?> </td>
                            <td> <?= $row->sobrenome; ?> </td>
                            <td> <?= $row->nascimento; ?> </td>
                            <td> <?= empty($row->cpf)? "" : $row->cpf; ?> </td>
                            <td> <?= $row->salario; ?> </td>
                            <td> <?= $row->cargo; ?> </td>
                            <td> <?= $row->cro; ?></td>
                            <td><a href="editar/editar-funcionario.php?id=<?=$row->funcionario_id?>" class="btn btn-primary">Alterar</a></td>
                            <?php $id = $row->funcionario_id; ?>
                            <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->id?>">Remover</a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                <?php 
                  } elseif($cargo = "Auxiliar"){ 
                ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr align="center">
                          <th>Nome</th>
                          <th>Sobrenome</th>
                          <th>Data de nascimento</th>
                          <th>CPF</th>
                          <th>Salário</th>
                          <th>Cargo</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php 
                          include_once '../../php/classAuxiliar.php';

                          $a = new Auxiliar();

                          $stmt = $a->viewAll();

                          while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                          <tr align="center">
                            <td> <?= $row->nome; ?> </td>
                            <td> <?= $row->sobrenome; ?> </td>
                            <td> <?= $row->nascimento; ?> </td>
                            <td> <?= empty($row->cpf)? "" : $row->cpf; ?> </td>
                            <td> <?= $row->salario; ?> </td>
                            <td> <?= $row->cargo; ?> </td>
                            <td><a href="editar/editar-funcionario.php?id=<?=$row->funcionario_id?>" class="btn btn-primary">Alterar</a></td>
                            <?php $id = $row->funcionario_id; ?>
                            <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->id?>">Remover</a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                <?php 
                  }
                }else{
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>Nome</th>
                      <th>Sobrenome</th>
                      <th>Data de nascimento</th>
                      <th>CPF</th>
                      <th>Salário</th>
                      <th>Cargo</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr align="center">
                      <th>Nome</th>
                      <th>Sobrenome</th>
                      <th>Data de nascimento</th>
                      <th>CPF</th>
                      <th>Salário</th>
                      <th>Cargo</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php 
                      include_once '../../php/classFuncionario.php';

                      $f = new Funcionario();

                      $stmt = $f->viewAll();

                      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                      <tr align="center">
                        <td> <?= $row->nome; ?> </td>
                        <td> <?= $row->sobrenome; ?> </td>
                        <td> <?= $row->nascimento; ?> </td>
                        <td> <?= empty($row->cpf)? "" : $row->cpf; ?> </td>
                        <td> <?= $row->salario; ?> </td>
                        <td> <?= $row->cargo; ?> </td>
                        <td><a href="editar/editar-funcionario.php?id=<?=$row->id?>" class="btn btn-primary">Alterar</a></td>
                        <?php $id = $row->id; ?>
                        <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?=$row->id?>">Remover</a></td>
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->
      <?php
      $f = new Funcionario();
      $stmt = $f->viewAll();

      while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
      <div class="modal fade" id="removeModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Você tem certeza que deseja remover?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Essa ação não poderá ser desfeita</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <form action="index.php" method="post">
              <input type="hidden" name="id" value="<?=$row->id?>">
              <button class="btn btn-primary" name="botao-remover">Remover</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php } include_once'footer.php' ?>