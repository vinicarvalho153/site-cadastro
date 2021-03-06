<?php
include('verificalogin.php');
include('banco.php');

if (isset($_POST['reg_item'])) {
  $objeto = mysqli_real_escape_string($conn, $_POST['objeto']);
  $emprestadoPara = mysqli_real_escape_string($conn, $_POST['emprestadoPara']);
  $dataEmprestado = mysqli_real_escape_string($conn, $_POST['dataEmprestado']);
  $usuario = $_SESSION['username'];

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO `item` (`id`, `objeto`, `emprestadoPara`, `dataEmprestado`, `usuario` ) VALUES (NULL, '$objeto', '$emprestadoPara', '$dataEmprestado', '$usuario')";

  if ($conn->query($sql) === TRUE) {
    header('location: index2.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<!doctype php>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" href="img/icone.png" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="css/signin.css" rel="stylesheet">
  <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
  <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Coisas Emprestadas | Cadastro Item</title>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>

<body class="text-center">
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index2.php">Início <span></span></a>
          </li>
          <li>
            <a href="informacoesUsuario.php"><button type="button" class="btn btn-light"><?php echo $_SESSION['username']; ?></button></a>
          </li>
        </ul>
        <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <br>
  <br>
  <br>
  <form class="form-signin" method="post" action="registerItemEmprestado.php">
    <h1 class="h3 mb-3 font-weight-normal">Faça o cadastro do item emprestado. </h1>


    <input autocomplete="off" class="form-control" placeholder="Item Emprestado" name="objeto" required autofocus>

    <input type="text" placeholder="Nome da pessoa que pegou o item" class="form-control" name="emprestadoPara" autocomplete="off" required>

    <input autocomplete="off" class="form-control" type="date" placeholder="Data" name="dataEmprestado" required autofocus>
    <div class="checkbox mb-3">
    </div>
    <a href="vagas.php"><button class="btn btn-lg btn-primary btn-block" type="submit" name="reg_item">Cadastrar Item</button></a>
  </form>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>