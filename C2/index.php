<?php
$conn = mysqli_connect('localhost', 'root', '', 'chat');
if (isset($_POST['submit'])) {

  if (empty($_POST['remetente']) || empty($_POST['destinatario']) || empty($_POST['mensagem'])) {
    echo "<p>Preencha todos os campos, por favor.</p>";
  } else {
    if (mysqli_connect_error()) {
      die("Falha na conexão com o banco de dados" . mysqli_connect_error());
    }
    $sql = "INSERT INTO mensagem (remetente, destinatario, mensagem, data_hora) VALUES ('{$_POST['remetente']}', '{$_POST['destinatario']}', '{$_POST['mensagem']}', NOW())";
    $query = mysqli_query($conn, $sql);
    if ($query) {
      echo "Inserido no banco com sucesso!";
    } else {
      echo "Erro ao inserir no banco" . mysqli_error($conn);
    }
  }
}
$sql = "SELECT * from mensagem ORDER BY data_hora DESC";
$query = mysqli_query($conn, $sql);

while ($mensagem = mysqli_fetch_assoc($query)) {
  echo "<div>";
  echo "<strong>Remetente:</strong> " . $mensagem['remetente'] . "<br>";
  echo "<strong>Destinatário:</strong> " . $mensagem['destinatario'] . "<br>";
  echo "<strong>Mensagem:</strong> " . $mensagem['mensagem'] . "<br>";
  echo "</div>";
  echo "<hr>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Correio Elegante</title>
</head>
<html>

<body>
  <h1>Correio elegante</h1>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div>
      <label for="exampleInputName1">Remetente</label>
      <input type="text" name="remetente" />
    </div>
    <div>
      <label>Destinatário</label>
      <input type="text" name="destinatario" />
    </div>
    <div>
      <label>Mensagem</label>
      <input type="text" name="mensagem" />
    </div>
    <button type="submit" name="submit">Enviar</button>
  </form>
</body>

</html>