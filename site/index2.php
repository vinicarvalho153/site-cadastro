<?php
include('verificalogin.php');
include('banco.php');
?>

<!doctype html>
<html lang="en">

<head>
  <link rel="icon" href="img/icone.png" />
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="css/carousel.css" rel="stylesheet">
  <link href="css/pricing.css" rel="stylesheet">
  <title>Coisas Emprestadas</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index2.php">Início <span class="sr-only">(current)</span></a>
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

  <main role="main" class="flex-shrink-0">
    <div class="container">
      <h1 class="mt-5">Bem-Vindo ao Coisas Emprestadas,<font color="#1d74de"> <?php echo $_SESSION['username']; ?></font>
      </h1><br>
    </div>

    <div class='container'>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>OBJETO</th>
            <th>EMPRESTADO PARA</th>
            <th>DATA</th>
            <th>DEVOLVIDO</th>
          </tr>
        </thead>
        <?php
        $usuario = $_SESSION['username'];
        $sql = "SELECT * FROM `item` WHERE `usuario` = '$usuario'";
        if (mysqli_query($conn, $sql)) {
          echo "";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $count = 1;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <tbody>
              <tr>
                <th>
                  <?php
                    echo $row['id'];
                  ?>
                </th>
                <td>
                  <?php echo $row['objeto']; ?>
                </td>
                <td>
                  <?php echo $row['emprestadoPara']; ?>
                </td>
                <td>
                  <?php
                  $dateRow = date_create($row['dataEmprestado']);
                  $dateNow = new DateTime("now");
                  if ($dateRow == $dateNow || $dateRow > $dateNow) {
                    echo "<font color = green>" . $row['dataEmprestado'] . "</font>";
                  } else {
                    echo "<font color = red>" . $row['dataEmprestado'] . " VENCIDO</font>";
                  }
                  // echo "<font color = red>" . $row['dataEmprestado'] . "</font>";
                  // echo "<font color = green>" . $row['dataEmprestado'] . "</font>";
                  ?>
                </td>
                <?php
                $objetoDevolvido = $row['objeto'];
                if (isset($_POST['devolvido'])) {
                  $sql = "UPDATE `item` SET `devolvido` = ('true') WHERE `usuario` = '$usuario'";

                  if ($conn->query($sql) === TRUE) {
                  } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                }
                ?>
                <td>
                  <?php
                  if ($row['devolvido'] === 'true') {
                    echo 'Devolvido';
                  } else {
                  ?><form method="post" action="index2.php">
                      <button type="submit" class="btn btn-primary" name="devolvido">
                        Devolvido
                      </button>
                    </form>
                  <?php
                  } ?>
                </td>
              </tr>
            </tbody>
        <?php
            $count++;
          }
        } else {
          echo '0 results';
        }
        ?>
      </table>
    </div>

    <div class="container">
      <p><a class="btn btn-primary btn-sm" href="registerItemEmprestado.php" role="button">Cadastrar Item</a></p>
    </div>
  </main>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="jquery-3.5.1.min.js"></script>
</body>

</html>