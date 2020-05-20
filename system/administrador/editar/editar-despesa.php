<?php include_once "header.php" ?>
<?php 
    include_once "../../../php/classDespesa.php";
    include_once "../../../php/classBalanco.php";

    $b = new Balanco();
    $d = new Despesa();

    $flag = 0;

    if(isset($_POST['botao'])){ 

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $novo_valor = $_POST['novo_valor'];
    $valor_antigo = $_POST['valor_antigo'];
    $tipo = $_POST['tipo'];
    $situacao = $_POST['situacao'];
    $administrador_id = $_SESSION['funcionario'];

    if($situacao == "Pago" && ($b->mostraSaldo() + $valor_antigo - $novo_valor) < 0){
        $flag = 1;
    }else{
        $d->setId($id);
        $d->setNome($nome);
        $d->setData($data);
        $d->setValor($novo_valor);
        $d->setTipo($tipo);
        $d->setSituacao($situacao);
        $d->setAdministradorId($administrador_id);
        var_dump($d->edit());
        header("Location: ../despesas.php");
    }

    $valor = $novo_valor;

}else{
    $id = $_GET['id'];
    $d = new Despesa();
    $d->setId($id);
    $despesa = $d->viewDespesa();

    $nome = $despesa->nome;
    $data = $despesa->data;
    $valor = $despesa->valor;
    $tipo = $despesa->tipo;
    $situacao = $despesa->situacao;
} 
?>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Atualização de Despesa
        </div>
        <div class="card-body">
        <?php if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Não há saldo suficiente</b>
          </div>
        <?php } ?>
          <form action="editar-despesa.php" method="post">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" required="required" autofocus="autofocus" name="nome" value="<?=$nome?>">
            </div>
            <div class="form-group">
                <label>Data</label>
                <input type="date" class="form-control" required="required" name="data" value="<?=$data?>">
            </div>
            <div class="form-group">
                <label>Valor</label>
                <input type="number" class="form-control" step="0.01" required="required" name="novo_valor" value="<?=$valor?>">
            </div>
            <div class="form-group">
                <label>Tipo</label><br>
                <select name="tipo">
                    <?php 
                    $dg = ($tipo == "Despesa Geral")? "selected='selected'" : "";
                    $dcf = ($tipo == "Despesa Com Funcionário")? "selected='selected'" : "";
                    ?> 
                    <option value="Despesa geral" <?=$dg?>>Despesa Geral</option>
                    <option value="Despesa com Funcionário" <?=$dcf?>>Despesa com Funcionário</option>
                </select>
            </div>
            <div class="form-group">
                <label>Situação</label><br>
                <select name="situacao">
                    <?php 
                    $pago = ($situacao == "Pago")? "selected='selected'" : "";
                    $nao_pago = ($situacao == "Não Pago")? "selected='selected'" : "";
                    ?> 
                    <option value="Pago" <?=$pago?>>Pago</option>
                    <option value="Não Pago" <?=$nao_pago?>>Não Pago</option>
                </select>
            </div>
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="valor_antigo" value="<?=$valor?>">
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


