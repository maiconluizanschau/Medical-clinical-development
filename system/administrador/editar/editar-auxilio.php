<?php include_once"header.php" ?>
<?php

$flag = 0;

    include_once "../../../php/classDentista.php";
    include_once "../../../php/classAuxiliar.php";
    include_once "../../../php/classAuxiliarAuxiliaDentista.php";

    $d = new Dentista();
    $a = new Auxiliar();
    $f = new Funcionario();
    $aad = new Auxiliar_auxilia_Dentista();

if(isset($_POST['botao'])){ 

    $dentista_id_atual = $_POST['dentista_id_atual'];
    $auxiliar_id_atual = $_POST['auxiliar_id_atual'];
    $nome_dentista = $_POST['nome_dentista'];
    $cro_dentista = $_POST['cro_dentista'];
    $nome_auxiliar = $_POST['nome_auxiliar'];
    $cpf_auxiliar = $_POST['cpf_auxiliar'];

    $auxiliar_id_novo = $a->existeNomeCpf($nome_auxiliar, $cpf_auxiliar);
    $dentista_id_novo = $d->existeNomeCro($nome_dentista, $cro_dentista);

    if(empty($dentista_id_novo)){
        $flag = 1;
    }

    if(empty($auxiliar_id_novo)){
        $flag += 2;
    }

    if($flag == 0){
        $aad->setDentistaId($dentista_id_atual);
        $aad->setAuxiliarId($auxiliar_id_atual);
        $aad->edit($dentista_id_novo, $auxiliar_id_novo);
        header("Location: ../auxilios.php");
    }

    $dentista_id = $dentista_id_novo;
    $auxiliar_id = $auxiliar_id_novo;

}else{
    $dentista_id = $_GET['dentista_id'];
    $auxiliar_id = $_GET['auxiliar_id'];

    $aad->setDentistaId($dentista_id);
    $aad->setAuxiliarId($auxiliar_id);

    $d->setFuncionarioId($dentista_id);
    $dentista = $d->viewDentista();
    $cro_dentista = $dentista->cro;

    $f->setId($dentista_id);
    $funcionario = $f->viewFuncionario();
    $nome_dentista = $funcionario->nome;

    $f->setId($auxiliar_id);
    $funcionario = $f->viewFuncionario();
    $cpf_auxiliar = $funcionario->cpf ;
    $nome_auxiliar = $funcionario->nome;
}
?>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Atualização de Auxílio
             <div class="float-right">
                <a href="../complementos/auxiliar.php" target="_blank" class="btn">Buscar auxiliares</a>
                <a href="../complementos/d-e.php" target="_blank" class="btn">Buscar dentistas</a>
            </div>
        </div>
        <div class="card-body">
        <?php if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>O nome e o CRO do dentista não estão cadastrados ou não coincidem</b>
          </div>
        <?php } elseif($flag == 2){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>O nome e o CPF do auxiliar não estão cadastrados ou não coincidem</b>
          </div>
        <?php } elseif($flag == 3){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Os dados informados não estão cadastrados ou não coincidem</b>
          </div>
        <?php } ?>
          <form action="editar-auxilio.php" method="post">
            <div class="form-group">
                <label>Nome do Dentista</label>
                <input type="text" class="form-control" required="required" name="nome_dentista" value="<?= $nome_dentista?>">
            </div>
            <div class="form-group">
                <label>CRO do Dentista</label>
                <input type="text" class="form-control" maxlength="5" name="cro_dentista" value="<?= $cro_dentista?>">
            </div>
            <div class="form-group">
                <label>Nome do Auxiliar</label>
                <input type="text" class="form-control" required="required" name="nome_auxiliar" value="<?= $nome_auxiliar?>">
            </div>
            <div class="form-group">
                <label>CPF do Auxiliar (somente números)</label>
                <input type="text" class="form-control" maxlength="11" name="cpf_auxiliar" value="<?= $cpf_auxiliar?>">
            </div>
            <input type="hidden" name="dentista_id_atual" value="<?=$dentista_id?>">
            <input type="hidden" name="auxiliar_id_atual" value="<?=$auxiliar_id?>">
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


