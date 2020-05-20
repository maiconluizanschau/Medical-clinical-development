<?php 
$flag = 0;
  
  session_start();

if(isset($_SESSION)){
  session_unset();
  session_destroy();
}

if(isset($_POST['login'])){

  session_start();

  $nome_usuario = $_POST["nome_usuario"];
  $senha = $_POST["senha"];
  $tipo  = $_POST["tipo"]; 

  if($tipo == "recepcionista"){
    require_once "php/classRecepcionista.php";
    $recepcionista = new Recepcionista();
    $recepcionista->setNomeUsuario($nome_usuario);
    $recepcionista->setSenha($senha);
    $funcionario_id = $recepcionista->existe();
    if(!is_null($funcionario_id)){
      $_SESSION["funcionario"] = $funcionario_id;
      header("Location: system/recepcionista/index.php");
    }else{
      $flag = 1;
    }
  }elseif($tipo == "administrador") {
    require_once "php/classAdministrador.php";
    $administrador = new Administrador();
    $administrador->setNomeUsuario($nome_usuario);
    $administrador->setSenha($senha);
    $funcionario_id = $administrador->existe();
    if(!is_null($funcionario_id)){
      $_SESSION["funcionario"] = $funcionario_id;
      header("Location: system/administrador/index.php");
    }else{
      $flag = 1;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login - Clínica Odontológica</div>
        <div class="card-body">
        <?php 
          if($flag == 1){ ?>
            <div class="alert alert-danger form-group" role="alert">
              <b>Nome de usuário e senha não correspondentes</b>
            </div>
        <?php
          }
        ?>
          <form action="index.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nome de usuário" required="required" autofocus="autofocus" name="nome_usuario">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Senha" required="required" name="senha">
            </div>
            <div class="form-group">
              <select name="tipo">
                <option value="recepcionista" checked="checked">Recepcionista</option>
                <option value="administrador">Administrador</option>
              </select>
            </div>
            <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
