<?php include_once"header.php" ?>
<?php

include_once "../../../php/classPaciente.php";
include_once "../../../php/classDentista.php";
include_once "../../../php/classDentistaConsultaPaciente.php";
include_once "../../../php/classPlanoDentario.php";

$p = new Paciente();
$pd = new PlanoDentario();
$d = new Dentista();
$dcp = new Dentista_consulta_Paciente();

$flag = 0;

if(isset($_POST['botao'])){ 
    
    $nome_dentista = $_POST['nome_dentista'];
    $cro_dentista = $_POST['cro_dentista'];
    $nome_paciente = $_POST['nome_paciente'];
    $cpf_paciente = $_POST['cpf_paciente'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $situacao = $_POST['situacao'];
    $operacao = $_POST['operacao'];

    $p->setNome($nome_paciente);
    $p->setCpf($cpf_paciente);

    if(!($id_dentista = $d->existeNomeCro($nome_dentista, $cro_dentista))){
        $flag = 1;
    } 

    if(!($id_paciente = $p->existeNomeCpf())){
        $flag += 2;
    }

    $dcp->setDentistaId($id_dentista);
    $dcp->setData($data);
    $dcp->setHorario($horario);

    if(!$dcp->horarioValidoCadastro()){
        $flag = 4;
    }

    if($flag == 0){
        $p->setId($id_paciente);
        $paciente = $p->viewPaciente();
        
        $plano_dentario_id = $paciente->plano_dentario_id; 
        $pd->setId($plano_dentario_id);
        $planoDentario = $pd->viewPlanoDentario();
        $valor_final = $valor - $valor*($planoDentario->desconto/100);

        $dcp->setDentistaId($id_dentista);
        $dcp->setPacienteId($id_paciente);
        $dcp->setValor($valor_final);
        $dcp->setData($data);
        $dcp->setHorario($horario);
        $dcp->setSituacao($situacao);
        $dcp->setOperacao($operacao);
        $id = $dcp->insert();

        if($situacao == "Pago"){
            header("Location: cadastrar-recebimentos-consultas.php?id=$id");  
        }else{
            header("Location: ../consultas.php");
        }
    }
}else{
$nome_dentista = "";
$cro_dentista = "";
$nome_paciente = "";
$cpf_paciente = "";
$valor = "";
$data = "";
$horario = "";
$situacao = "";
$operacao = "";

}
?>
  <body class="bg-dark">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Cadastro de Consulta
          <div class="float-right">
            <a href="../complementos/paciente-consulta.php" target="_blank" class="btn">Buscar pacientes</a>
            <a href="../complementos/dentista-consulta.php" target="_blank" class="btn">Buscar dentistas</a>
          </div>
        </div>
        <div class="card-body">
        <?php 
        if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>O nome e o CRO do dentista não estão cadastrados ou não coincidem</b>
          </div>
        <?php } elseif($flag == 2){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>O nome e o CPF do paciente não estão cadastrados ou não coincidem</b>
          </div>
        <?php } elseif($flag == 3){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Os dados informados não estão cadastrados ou não coincidem</b>
          </div>
        <?php } elseif($flag == 4){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Já há uma pessoa agendada</b>
          </div>
        <?php }  ?>
          <form action="cadastrar-consulta.php" method="post">
            <div class="form-group">
                <label>Operação</label>
                <input type="text" class="form-control" required="required" autofocus="autofocus" name="operacao" value="<?= $operacao ?>">
            </div>
            <div class="form-group">
                <label>Nome do Paciente</label>
                <input type="text" class="form-control" name="nome_paciente" value="<?= $nome_paciente ?>">
            </div>
            <div class="form-group">
                <label>CPF do Paciente (somente números)</label>
                <input type="text" class="form-control" maxlength="11" name="cpf_paciente" value="<?= $cpf_paciente ?>">
            </div>
            <div class="form-group">
                <label>Nome do Dentista</label>
                <input type="text" class="form-control" required="required" name="nome_dentista" value="<?= $nome_dentista ?>">
            </div>
            <div class="form-group">
                <label>CRO do Dentista</label>
                <input type="text" class="form-control" maxlength="5" name="cro_dentista" value="<?= $cro_dentista ?>">
            </div>
            <div class="form-group">
                <label>Data</label>
                <input type="date" class="form-control" required="required" name="data" value="<?= $data ?>">
            </div>
            <div class="form-group">
                <label>Horário</label>
                <input type="time" class="form-control" required="required" autofocus="autofocus" name="horario" value="<?= $horario ?>">
            </div>
            <div class="form-group">
                <label>Valor</label>
                <input type="number"  step="0.01" class="form-control" required="required" autofocus="autofocus" name="valor" value="<?= $valor ?>">
            </div>
            <div class="form-group">
                <label>Situação</label><br>
                <select name="situacao">
                    <option value="Pago">Pago</option>
                    <option value="Não Pago">Não Pago</option>
                </select>
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
