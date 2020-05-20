<?php include_once"header.php" ?>
<?php 

$flag = 0;

include_once "../../../php/classPlanoDentario.php";
$p = new PlanoDentario();

if(isset($_POST['botao'])){ 
  
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $desconto = $_POST['desconto'];
  
  if($p->existe($nome, $id)){
    $flag = 1;
  }

  if($flag == 0){
    $p->setId($id);
    $p->setNome($nome);
    $p->setDesconto($desconto);
    $p->edit();
    header("Location: ../planos-dentarios.php");
  }

}else{

  $id = $_GET['id'];
  $p->setId($id);
  $pd = $p->viewPlanoDentario();
  $nome = $pd->nome;
  $desconto = $pd->desconto;

} 
?>
<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">
       Atualização de Plano Dentário
      </div>
      <div class="card-body">
        <?php if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Esse plano dentário já está cadastrado</b>
          </div>
        <?php } ?>
        <form action="editar-plano-dentario.php" method="post">
          <div class="form-group">
              <label>Nome</label>
              <input type="text" class="form-control" required="required" autofocus="autofocus" name="nome" value="<?=$nome?>">
          </div>
          <div class="form-group">
              <label>Desconto em %</label>
              <input type="number" class="form-control" required="required" name="desconto" value="<?=$desconto?>">
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


