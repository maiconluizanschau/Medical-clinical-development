<?php include_once "header.php" ?>
<?php 

$flag = 0;

if(isset($_POST['botao'])){ 
    include_once "../../../php/classDespesa.php";
    include_once "../../../php/classBalanco.php";

    $b = new Balanco();
    $d = new Despesa();

    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];
    $situacao = $_POST['situacao'];
    $administrador_id = $_SESSION['funcionario'];

    if($situacao == "Pago" && $b->mostraSaldo()-$valor < 0){
        $flag = 1;
    }else{
    $d->setNome($nome);
    $d->setData($data);
    $d->setValor($valor);
    $d->setTipo($tipo);
    $d->setSituacao($situacao);
    $d->setAdministradorId($administrador_id);
    $d->insert();

    header("Location: ../despesas.php");
    }
}
?>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Cadastro de Despesa
        </div>
        <div class="card-body">
        <?php if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Não há saldo suficiente</b>
          </div>
        <?php } ?>
          <form action="cadastrar-despesa.php" method="post">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" required="required" autofocus="autofocus" name="nome">
            </div>
            <div class="form-group">
                <label>Data</label>
                <input type="date" class="form-control" required="required" name="data">
            </div>
            <div class="form-group">
                <label>Valor</label>
                <input type="number" step="0.01" class="form-control" required="required" name="valor">
            </div>
            <div class="form-group">
                <label>Tipo</label><br>
                <select name="tipo">
                    <option value="Despesa geral">Despesa Geral</option>
                    <option value="Despesa com Funcionário">Despesa com Funcionário</option>
                </select>
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


