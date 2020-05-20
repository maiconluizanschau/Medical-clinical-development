<?php include_once"header.php" ?>
<?php 

$flag = 0;

if(isset($_POST['botao'])){ 
  include_once "../../../php/classFuncionario.php";

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $nascimento = $_POST['nascimento'];
  $cpf = $_POST['cpf'];
  $salario = $_POST['salario'];
  $cargo = $_POST['cargo'];

  $funcionario = new Funcionario();

  $funcionario->setCpf($cpf);
  if(!$funcionario->validaCPF($cpf)) $flag = 1;

  if($flag == 0){
      $flag = 2;

    if($cargo == "Recepcionista"){

      include_once "../../../php/classRecepcionista.php";
      $recepcionista = new Recepcionista();
      $recepcionista->setFuncionarioId($id);
      $resultado = $recepcionista->viewRecepcionista();

    }elseif($cargo == "Administrador"){

      include_once "../../../php/classAdministrador.php";
      $administrador = new Administrador();
      $administrador->setFuncionarioId($id);
      $resultado = $administrador->viewAdministrador();

    }elseif($cargo == "Dentista"){

      include_once "../../../php/classDentista.php";
      $dentista = new Dentista();
      $dentista->setFuncionarioId($id);
      $resultado = $dentista->viewDentista();
    }
  }
}elseif(isset($_POST['botao-detalhe'])){
  include_once "../../../php/classFuncionario.php";

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $nascimento = $_POST['nascimento'];
  $cpf = $_POST['cpf'];
  $salario = $_POST['salario'];
  $cargo = $_POST['cargo'];

  $funcionario = new Funcionario();

  $funcionario->setId($id);
  $funcionario->setCpf($cpf);
  $funcionario->setNome($nome);
  $funcionario->setSobrenome($sobrenome);
  $funcionario->setNascimento($nascimento);
  $funcionario->setSalario($salario);
  $funcionario->setCargo($cargo);
  $v = $funcionario->edit();

  if($cargo == "Auxiliar"){
    
    include_once "../../../php/classAuxiliar.php";
    $auxiliar = new Auxiliar();
    $auxiliar->setFuncionarioId($id);
    $estado = $auxiliar->edit();

  }elseif($cargo == "Recepcionista"){

    $nome_usuario = $_POST["nome_usuario"];
    $senha = $_POST["senha"];
    include_once "../../../php/classRecepcionista.php";
    $recepcionista = new Recepcionista();
    $recepcionista->setFuncionarioId($id);
    $recepcionista->setNomeUsuario($nome_usuario);
    $recepcionista->setSenha($senha);
    $estado = $recepcionista->edit();

  }elseif($cargo == "Administrador"){

    $nome_usuario = $_POST["nome_usuario"];
    $senha = $_POST["senha"];
    include_once "../../../php/classAdministrador.php";
    $administrador = new Administrador();
    $administrador->setFuncionarioId($id);
    $administrador->setSenha($senha);
    $administrador->setNomeUsuario($nome_usuario);
    $estado = $administrador->edit();

  }elseif($cargo == "Dentista"){
    $cro = $_POST["cro"];
    include_once "../../../php/classDentista.php";
    $dentista = new Dentista();
    $dentista->setFuncionarioId($id);
    $dentista->setCro($cro);
    $estado = $dentista->edit();
  }  
  header("Location: ../index.php");

 }else{ 
    include_once "../../../php/classFuncionario.php";

    $id = $_GET['id'];
    $funcionario = new Funcionario();
    $funcionario->setId($id);
    $resultado = $funcionario->viewFuncionario();
    $cargo = $resultado->cargo; 
}
?>
  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Atualização de Funcionário
        </div>
        <div class="card-body">
        <?php if($flag == 0){ ?>
          <form action="editar-funcionario.php" method="post">
            <div class="form-group">
                <label>Primeiro nome</label>
                <input type="text" class="form-control" required="required" autofocus="autofocus" name="nome" value="<?= $resultado->nome ?>">
            </div>
            <div class="form-group">
                <label>Sobrenome</label>
                <input type="text" class="form-control" required="required" name="sobrenome" value="<?= $resultado->sobrenome ?>">
            </div>
            <div class="form-group">
                <label>Data de nascimento</label>
                <input type="date" class="form-control" required="required" name="nascimento" value="<?= $resultado->nascimento ?>">
            </div>
            <div class="form-group">
                <label>CPF (somente números)</label>
                <input type="text" class="form-control" maxlength="11" name="cpf" value="<?= $resultado->cpf ?>">
            </div>
            <div class="form-group">
                <label>Salário</label>
                <input type="number" step="0.01" class="form-control" required="required" name="salario" value="<?= $resultado->salario ?>">
            </div>
            <input type="hidden" name="id" value=<?=$id?>>
            <input type="hidden" name="cargo" value=<?=$cargo?>>
            <button class="btn btn-primary btn-block" type="submit" name="botao">Avançar</button>
          </form>
        <?php }
        elseif($flag == 1){ ?>
          <div class="alert alert-danger form-group" role="alert">
            <b>O CPF informado não é válido</b>
          </div>
          <form action="editar-funcionario.php" method="post">
            <div class="form-group">
                <label>Primeiro nome</label>
                <input type="text" class="form-control" required="required" autofocus="autofocus" name="nome" value="<?=$nome?>">
            </div>
            <div class="form-group">
                <label>Sobrenome</label>
                <input type="text" class="form-control" required="required" name="sobrenome" value="<?=$sobrenome?>">
            </div>
            <div class="form-group">
                <label>Data de nascimento</label>
                <input type="date" class="form-control" required="required" name="nascimento" value="<?=$nascimento?>">
            </div>
            <div class="form-group">
                <label>CPF (somente números)</label>
                <input type="text" class="form-control" maxlength="11" name="cpf">
            </div>
            <div class="form-group">
                <label>Salário</label>
                <input type="number" step="0.01" class="form-control" required="required" name="salario" value="<?=$salario?>"> 
            </div>
            <input type="hidden" name="id" value=<?=$id?>>
            <input type="hidden" name="cargo" value=<?=$cargo?>>
            <button class="btn btn-primary btn-block" type="submit" name="botao">Avançar</button>
          </form>
       <?php }
       elseif($flag == 2){ ?>
          <form action="editar-funcionario.php" method="post">
    <?php  if ($cargo == "Recepcionista" || $cargo == "Administrador") { ?>
            <div class="form-group">
              <label>Nome de usuário</label>
              <input type="text" class="form-control" required="required" autofocus="autofocus" name="nome_usuario" value="<?=$resultado->nome_usuario?>">
            </div>
            <div class="form-group">
              <label>Senha</label>
              <input type="password" class="form-control" required="required" autofocus="autofocus" name="senha">
            </div>
    <?php } elseif ($cargo == "Dentista") { ?>
            <div class="form-group">
              <label>CRO</label>
              <input type="text" class="form-control" required="required" autofocus="autofocus" maxlength="5" name="cro" value="<?=$resultado->cro?>">
            </div> 
        <?php } ?>
            <input type="hidden" name="id" value=<?=$id?>>
            <input type="hidden" name="nome" value=<?=$nome?>>
            <input type="hidden" name="sobrenome" value=<?=$sobrenome?>>
            <input type="hidden" name="nascimento" value=<?=$nascimento?>>
            <input type="hidden" name="cpf" value=<?=$cpf?>>
            <input type="hidden" name="salario" value=<?=$salario?>>
            <input type="hidden" name="cargo" value=<?=$cargo?>>
            <button class="btn btn-primary btn-block" type="submit" name="botao-detalhe">Atualizar</button>
      </form>
       <?php } ?> 
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


