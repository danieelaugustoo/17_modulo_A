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
      echo "Erro ao inserior no banco" . mysqli_error($conn);
    }
  }
}
?>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'chat');
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>
<html>

<body>
  <h1 class="text-center">Correio elegante &#10084;&#65039</h1>
  <hr class=" my-5 bg-danger opacity-50 w-50">
  <form class="m-2 p-3" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="exampleInputName1">Remetente</label>
      <input type="text" class="form-control" id="exampleInputName1" aria-describedby="nameHelp"
        name="remetente" />
    </div>
    <div class="form-group">
      <label for="exampleInputName2">Destinatário</label>
      <input type="text" class="form-control" id="exampleInputName2" aria-describedby="nameHelp"
        name="destinatario" />
    </div>
    <div class="form-group">
      <label for="exampleInputName3">Mensagem</label>
      <input type="text" class="form-control" id="exampleInputName3" aria-describedby="nameHelp"
        name="mensagem" />
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Enviar</button>
  </form>
</body>

</html>