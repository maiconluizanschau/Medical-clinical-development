<?php include_once"header.php" ?>

<?php

$flag = 0;

if(isset($_POST['botao'])){ 
  include_once "../../../php/classEspecialidade.php";
  
  $nome = $_POST['nome'];
  $nome_atual = $_POST['nome_atual'];

  $e = new Especialidade();
  $e->setNome($nome_atual);

  if(!$e->nomeValido($nome)){
    $flag = 1;
  }else{
    $e->edit($nome);

    header("Location: ../especialidades.php");
  }
}else{
  $nome = $_GET['nome'];
} ?>
<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">
        Atualização de Especialidade
      </div>
      <div class="card-body">
        <?php if($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>Especialidade já cadastrada</b>
          </div>
        <?php } ?>
        <form action="editar-especialidade.php" method="post">
          <div class="form-group">
              <label>Nome</label>
              <input type="text" class="form-control" required="required" autofocus="autofocus" name="nome" value="<?=$nome?>">
              <input type="hidden" name="nome_atual" value="<?=$nome?>">
          </div>
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


