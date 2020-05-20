<?php include_once"header.php" ?>
<?php

$flag = 0;

if(!isset($_POST['nome_dentista']))$nome_dentista = "";
if(!isset($_POST['cro_dentista']))$cro_dentista = "";
if(!isset($_POST['nome_auxiliar']))$nome_auxiliar = "";
if(!isset($_POST['cpf_auxiliar']))$cpf_auxiliar = "";

if(isset($_POST['botao'])){ 
    include_once "../../../php/classDentista.php";
    include_once "../../../php/classAuxiliar.php";
    include_once "../../../php/classAuxiliarAuxiliaDentista.php";

    $d = new Dentista();
    $a = new Auxiliar();
    $aad = new Auxiliar_auxilia_Dentista();

    $nome_dentista = $_POST['nome_dentista'];
    $cro_dentista = $_POST['cro_dentista'];
    $nome_auxiliar = $_POST['nome_auxiliar'];
    $cpf_auxiliar = $_POST['cpf_auxiliar'];

    if(!($id_dentista = $d->existeNomeCro($nome_dentista, $cro_dentista))){
        $flag = 1;
    }

    if(!($id_auxiliar = $a->existeNomeCpf($nome_auxiliar, $cpf_auxiliar))){
        $flag += 2;
    }

    if($flag == 0){
        $aad->setDentistaId($id_dentista);
        $aad->setAuxiliarId($id_auxiliar);
        $aad->insert();
        header("Location: ../auxilios.php");
    }
}
?>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Cadastro de Auxílio
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
          <form action="cadastrar-auxilio.php" method="post">
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
            <button class="btn btn-primary btn-block" type="submit" name="botao">Cadastrar</button>
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


