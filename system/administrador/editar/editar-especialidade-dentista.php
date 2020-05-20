<?php include_once"header.php" ?>
<?php

include_once "../../../php/classDentista.php";
include_once "../../../php/classEspecialidade.php";
include_once "../../../php/classDentistaHasEspecialidade.php";

$f = new funcionario();
$d = new Dentista();
$e = new Especialidade();
$dhe = new Dentista_has_Especialidade();

$flag = 0;

if(isset($_POST['botao'])){ 

    $dentista_id_atual = $_POST['dentista_id_atual'];
    $especialidade_atual = $_POST['especialidade_atual'];
    $nome_dentista = $_POST['nome_dentista'];
    $cro_dentista = $_POST['cro_dentista'];
    $nova_especialidade = $_POST['nova_especialidade'];
    
    $dentista_id_novo = $d->existeNomeCro($nome_dentista, $cro_dentista);

    if(!$dhe->existeDentista($dentista_id_novo)) $flag = 1;

    if($flag == 0){

    $dhe->setDentistaId($dentista_id_atual);
    $dhe->setEspecialidadeNome($especialidade_atual);
    var_dump($dhe->edit($dentista_id_novo, $nova_especialidade));
    header("Location: ../especialidades-dentistas.php");

    }else{
        $dentista_id = $dentista_id_novo;
        $especialidade_nome = $nova_especialidade;
    }
}else{
    $dentista_id = $_GET['dentista_id'];
    $especialidade_nome = $_GET['especialidade_nome'];

    $dhe->setDentistaId($dentista_id);
    $dhe->setEspecialidadeNome($especialidade_nome);
    $esp_den = $dhe->viewDentistaHasEspecialidade();

    $dentista_id = $esp_den->dentista_id;
    $d->setFuncionarioId($dentista_id);
    $dentista = $d->viewDentista();
    $cro_dentista = $dentista->cro;

    $f->setId($dentista_id);
    $funcionario = $f->viewFuncionario();
    $nome_dentista = $funcionario->nome;
}

?>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Atualização de Especialidade para Dentista
             <div class="float-right">
                <a href="../complementos/d-e.php" target="_blank" class="btn">Buscar dentistas</a>
            </div>
        </div>
        <div class="card-body">
        <?php if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Não há esse dentista cadastrado</b>
          </div>
        <?php } ?>
          <form action="editar-especialidade-dentista.php" method="post">
            <div class="form-group">
                <label>Nome do Dentista</label>
                <input type="text" class="form-control" required="required" name="nome_dentista" value="<?= $nome_dentista ?>">
            </div>
            <div class="form-group">
                <label>CRO do Dentista</label>
                <input type="text" class="form-control" maxlength="5" name="cro_dentista" value="<?=$cro_dentista?>">
            </div>
            <div class="form-group">
                <label>Especialidade</label><br>
                <select name="nova_especialidade">
                <?php 
                include_once "../../../php/classEspecialidade.php";
                $e = new Especialidade();
                $stmt = $e->viewAll();

                while($row = $stmt->fetch(PDO::FETCH_OBJ)){ ?>
                <?php $selected  = ($row->nome == $especialidade_nome)? "selected='selected'" : "" ?>
                <option value= "<?= $row->nome; ?>"<?=$selected?>> <?= $row->nome; ?> </option>
                <?php } ?>
                </select>
            </div>
            <input type="hidden" name="dentista_id_atual" value="<?=$dentista_id?>">
            <input type="hidden" name="especialidade_atual" value="<?=$especialidade_nome?>">
            <button class="btn btn-primary btn-block" type="submit" name="botao">Atualizar</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>
</html>


