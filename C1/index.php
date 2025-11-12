<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página Principal</title>
</head>

<body>
  <nav>
    <div>
      <div>
        <a href="logout.php">Sair</a>
      </div>
    </div>
  </nav>

  <div>
    <div>
      <h1>Bem-vindo à Página Principal!</h1>
      <p>Você está logado com sucesso.</p>
    </div>
  </div>
</body>

</html>