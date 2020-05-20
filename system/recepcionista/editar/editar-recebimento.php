<?php include_once"header.php" ?>
<?php

$flag = 0;

include_once "../../../php/classPaciente.php";
include_once "../../../php/classRecepcionista.php";
include_once "../../../php/classRecebimento.php";

$paciente = new Paciente();
$recebimento = new Recebimento();

if(!isset($_POST['valor']))$valor = "";
if(!isset($_POST['data']))$data = "";
if(!isset($_POST['nome_paciente']))$nome_paciente = "";
if(!isset($_POST['cpf_paciente']))$cpf_paciente = "";
if(!isset($_POST['modo_pagamento']))$modo_pagamento = "";

if(isset($_POST['botao'])){ 

    $id = $_POST['id'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $nome_paciente = $_POST['nome_paciente'];
    $cpf_paciente = $_POST['cpf_paciente'];
    $modo_pagamento = $_POST['modo_pagamento'];

    $id_recepcionista = $_SESSION['funcionario'];

    $paciente->setNome($nome_paciente);
    $paciente->setCpf($cpf_paciente);
    
    $recebimento->setId($id);

    if($paciente->semNomeCpf()){
        $recebimento->setValor($valor);
        $recebimento->setData($data);
        $recebimento->setRecepcionistaId($id_recepcionista);
        $recebimento->setModoPagamento($modo_pagamento);
        $recebimento->edit();
        header("Location: ../recebimentos.php");

    }elseif($id_paciente = $paciente->existeNomeCpf()){
        $recebimento->setPacienteId($id_paciente);
        $recebimento->setValor($valor);
        $recebimento->setData($data);
        $recebimento->setRecepcionistaId($id_recepcionista);
        $recebimento->setModoPagamento($modo_pagamento);
        var_dump($recebimento->edit());
        header("Location: ../recebimentos.php");
    }
    else{
        $flag = 1;
    }
}else{
    $id = $_GET['id'];
    $recebimento->setId($id);
    $r = $recebimento->viewRecebimento();

    $valor = $r->valor;
    $data = $r->data;
    $modo_pagamento = $r->modo_pagamento;

    $paciente_id = $r->paciente_id;

    if(!empty($paciente_id)){
        $paciente->setId($paciente_id);
        $p = $paciente->viewPaciente();
        $nome_paciente = $p->nome;
        $cpf_paciente = $p->cpf;
    }

}

?>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Atualização de Recebimento
            <div class="float-right">
                <a href="../complementos/paciente-recebimento.php" target="_blank" class="btn">Buscar pacientes</a>
            </div>
        </div>
        <div class="card-body">
        <?php if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Não há esse paciente cadastrado</b>
          </div>
        <?php } ?>
          <form action="editar-recebimento.php" method="post">
            <div class="form-group">
                <label>Nome do Paciente</label>
                <input type="text" class="form-control" name="nome_paciente" value="<?= $nome_paciente ?>">
            </div>
            <div class="form-group">
                <label>CPF do Paciente (somente números)</label>
                <input type="text" class="form-control" maxlength="11" name="cpf_paciente" value="<?= $cpf_paciente ?>">
            </div>
            <div class="form-group">
                <label>Valor</label>
                <input type="number" class="form-control"  step="0.01" required="required" autofocus="autofocus" name="valor" value="<?= $valor ?>">
            </div>
            <div class="form-group">
                <label>Modo de Pagamento</label><br>
                <select name="modo_pagamento">
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                    <option value="Cartão de Débito">Cartão de Débito</option>
                    <option value="Espécie">Espécie</option>
                </select>
            </div>
            <div class="form-group">
                <label>Data</label>
                <input type="date" class="form-control" required="required" name="data" value="<?= $data ?>">
            </div>
            <input type="hidden" name="id" value="<?=$id?>">
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


